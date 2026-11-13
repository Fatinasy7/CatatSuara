const pageTitles = {
    home: 'Beranda',
    transactions: 'Transaksi',
    reports: 'Laporan KUR',
    settings: 'Pengaturan',
};

const transactions = [
    { id: 1, description: 'Penjualan minyak goreng 2L', date: 'Hari ini, 10:42', category: 'Penjualan', wallet: 'Kas Usaha', amount: 34000, type: 'income', source: 'Suara AI' },
    { id: 2, description: 'Belanja minyak goreng', date: 'Hari ini, 09:18', category: 'Belanja dagangan', wallet: 'Kas Usaha', amount: 85000, type: 'expense', source: 'Teks' },
    { id: 3, description: 'Penjualan paket sembako', date: 'Kemarin, 16:20', category: 'Penjualan', wallet: 'Kas Usaha', amount: 320000, type: 'income', source: 'Suara AI' },
    { id: 4, description: 'Bayar listrik rumah', date: 'Kemarin, 19:40', category: 'Operasional', wallet: 'Kas Pribadi', amount: 150000, type: 'expense', source: 'Suara AI' },
    { id: 5, description: 'Beli bensin motor', date: '23 Okt 2024, 08:15', category: 'Transportasi', wallet: 'Kas Pribadi', amount: 20000, type: 'expense', source: 'Teks' },
];

const modal = document.querySelector('#transaction-modal');
const onboardingModal = document.querySelector('#onboarding-modal');
const transactionForm = document.querySelector('#transaction-form');
const toast = document.querySelector('#toast-message');
let editingTransactionId = null;
let toastTimer;
let recognition = null;

const formatRupiah = (amount) => new Intl.NumberFormat('id-ID').format(amount);

const escapeHtml = (value) => String(value).replace(/[&<>"']/g, (character) => ({
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;',
}[character]));

const transactionCategoryClass = (transaction) => {
    if (transaction.type === 'income') {
        return 'category-pill';
    }

    return transaction.wallet === 'Kas Pribadi' ? 'category-pill category-personal' : 'category-pill category-expense';
};

const renderTransactionRow = (transaction, showActions = false) => {
    const isIncome = transaction.type === 'income';
    const amountClass = isIncome ? 'amount-positive' : 'amount-negative';
    const sign = isIncome ? '+' : '−';
    const walletClass = transaction.wallet === 'Kas Pribadi' ? 'wallet-pill wallet-personal' : 'wallet-pill';
    const actions = showActions
        ? `<td class="action-cell"><button class="row-action" data-edit="${transaction.id}" aria-label="Ubah ${escapeHtml(transaction.description)}">✎</button><button class="row-action" data-delete="${transaction.id}" aria-label="Hapus ${escapeHtml(transaction.description)}">×</button></td>`
        : '';

    return `<tr>
        <td><span class="table-item"><span class="table-icon ${isIncome ? 'sales-icon' : 'expense-icon'}">${isIncome ? '↗' : '↓'}</span><span><strong>${escapeHtml(transaction.description)}</strong><small>Dicatat melalui ${escapeHtml(transaction.source)}</small></span></span></td>
        <td>${escapeHtml(transaction.date)}</td>
        <td><span class="${transactionCategoryClass(transaction)}">${escapeHtml(transaction.category)}</span></td>
        <td><span class="${walletClass}">${escapeHtml(transaction.wallet)}</span></td>
        <td class="align-right ${amountClass}">${sign}Rp ${formatRupiah(transaction.amount)}</td>
        ${actions}
    </tr>`;
};

const renderTransactions = () => {
    const recent = document.querySelector('#recent-transactions');
    const list = document.querySelector('#transaction-list');
    const searchTerm = document.querySelector('#transaction-search').value.trim().toLocaleLowerCase('id');
    const selectedWallet = document.querySelector('#wallet-filter').value;
    const selectedType = document.querySelector('#type-filter').value;
    const filteredTransactions = transactions.filter((transaction) => {
        const matchesSearch = `${transaction.description} ${transaction.category}`.toLocaleLowerCase('id').includes(searchTerm);
        const matchesWallet = selectedWallet === 'all' || transaction.wallet === selectedWallet;
        const matchesType = selectedType === 'all' || transaction.type === selectedType;

        return matchesSearch && matchesWallet && matchesType;
    });

    recent.innerHTML = transactions.slice(0, 3).map((transaction) => renderTransactionRow(transaction)).join('');
    list.innerHTML = filteredTransactions.map((transaction) => renderTransactionRow(transaction, true)).join('');
    document.querySelector('#empty-transactions').hidden = filteredTransactions.length > 0;
    document.querySelector('.ledger-table').hidden = filteredTransactions.length === 0;
    document.querySelector('#transaction-count').textContent = `Menampilkan ${filteredTransactions.length} dari ${transactions.length} transaksi demo`;
    document.querySelector('#saved-count').textContent = String(142 + transactions.length - 5);
};

const showToast = (message) => {
    toast.textContent = message;
    toast.classList.add('is-visible');
    window.clearTimeout(toastTimer);
    toastTimer = window.setTimeout(() => toast.classList.remove('is-visible'), 3000);
};

const navigateTo = (viewName) => {
    if (!pageTitles[viewName]) {
        return;
    }

    document.querySelectorAll('[data-view]').forEach((panel) => {
        panel.hidden = panel.dataset.view !== viewName;
        panel.classList.toggle('is-visible', panel.dataset.view === viewName);
    });

    document.querySelectorAll('[data-nav]').forEach((button) => {
        const isCurrent = button.dataset.nav === viewName;
        button.classList.toggle('is-active', isCurrent);

        if (isCurrent) {
            button.setAttribute('aria-current', 'page');
        } else {
            button.removeAttribute('aria-current');
        }
    });

    document.querySelector('#page-title').textContent = pageTitles[viewName];
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

const closeModal = (dialog) => {
    dialog.hidden = true;
    document.body.classList.remove('modal-open');
};

const openModal = (dialog) => {
    modal.hidden = dialog !== modal;
    onboardingModal.hidden = dialog !== onboardingModal;
    document.body.classList.add('modal-open');
    window.setTimeout(() => {
        const firstInput = dialog.querySelector('input, select, button');
        firstInput?.focus();
    }, 0);
};

const parseSpokenAmount = (description) => {
    const amounts = [...description.matchAll(/(\d+(?:[.,]\d+)?)\s*(juta|jt|ribu|rb)?/gi)];
    const amountMatch = [...amounts].reverse().find((match) => match[2]) ?? amounts.at(-1);

    if (!amountMatch) {
        return '';
    }

    const numericAmount = Number(amountMatch[1].replace(',', '.'));
    const multiplier = /juta|jt/i.test(amountMatch[2] ?? '') ? 1000000 : /ribu|rb/i.test(amountMatch[2] ?? '') ? 1000 : 1;

    return String(Math.round(numericAmount * multiplier));
};

const prepareTransaction = (description = '', amount = '') => {
    editingTransactionId = null;
    transactionForm.reset();
    document.querySelector('#transaction-modal-title').textContent = 'Catat transaksi';
    document.querySelector('#voice-transcript').textContent = description || 'Ketik transaksi Anda, lalu simpan ke buku kas.';
    document.querySelector('#transaction-description').value = description;
    document.querySelector('#transaction-amount').value = amount || parseSpokenAmount(description);
    document.querySelector('#transaction-type').value = /\b(jual|penjualan|terjual|pemasukan)\b/i.test(description) ? 'income' : 'expense';
    document.querySelector('#transaction-wallet').value = /\b(pribadi|rumah)\b/i.test(description) ? 'Kas Pribadi' : 'Kas Usaha';
    openModal(modal);
};

const exportCsv = () => {
    const rows = [
        ['Deskripsi', 'Tanggal', 'Kategori', 'Dompet', 'Jenis', 'Nominal'],
        ...transactions.map((transaction) => [
            transaction.description,
            transaction.date,
            transaction.category,
            transaction.wallet,
            transaction.type === 'income' ? 'Pemasukan' : 'Pengeluaran',
            transaction.amount,
        ]),
    ];
    const csv = `\uFEFF${rows.map((row) => row.map((cell) => `"${String(cell).replace(/"/g, '""')}"`).join(',')).join('\r\n')}`;
    const file = new Blob([csv], { type: 'text/csv;charset=utf-8' });
    const link = document.createElement('a');
    const fileUrl = URL.createObjectURL(file);

    link.href = fileUrl;
    link.download = 'sorafin-transaksi-demo.csv';
    document.body.append(link);
    link.click();
    link.remove();
    URL.revokeObjectURL(fileUrl);
    showToast('File CSV transaksi demo berhasil diunduh.');
};

document.querySelectorAll('[data-nav]').forEach((button) => {
    button.addEventListener('click', () => navigateTo(button.dataset.nav));
});

document.querySelectorAll('[data-open-transaction]').forEach((button) => {
    button.addEventListener('click', () => prepareTransaction());
});

document.querySelectorAll('[data-open-onboarding]').forEach((button) => {
    button.addEventListener('click', () => openModal(onboardingModal));
});

document.querySelectorAll('[data-close-modal]').forEach((button) => {
    button.addEventListener('click', () => closeModal(button.closest('.modal-backdrop')));
});

document.querySelectorAll('.modal-backdrop').forEach((backdrop) => {
    backdrop.addEventListener('click', (event) => {
        if (event.target === backdrop) {
            closeModal(backdrop);
        }
    });
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        document.querySelectorAll('.modal-backdrop:not([hidden])').forEach(closeModal);
    }
});

document.querySelectorAll('[data-toast]').forEach((button) => {
    button.addEventListener('click', () => showToast(button.dataset.toast));
});

document.querySelector('#transaction-search').addEventListener('input', renderTransactions);
document.querySelector('#wallet-filter').addEventListener('change', renderTransactions);
document.querySelector('#type-filter').addEventListener('change', renderTransactions);
document.querySelector('#reset-filters').addEventListener('click', () => {
    document.querySelector('#transaction-search').value = '';
    document.querySelector('#wallet-filter').value = 'all';
    document.querySelector('#type-filter').value = 'all';
    renderTransactions();
});

document.querySelector('#transaction-list').addEventListener('click', (event) => {
    const editButton = event.target.closest('[data-edit]');
    const deleteButton = event.target.closest('[data-delete]');

    if (editButton) {
        const transaction = transactions.find((item) => item.id === Number(editButton.dataset.edit));

        if (transaction) {
            editingTransactionId = transaction.id;
            document.querySelector('#transaction-modal-title').textContent = 'Ubah transaksi';
            document.querySelector('#voice-transcript').textContent = 'Perbarui rincian transaksi demo Anda.';
            document.querySelector('#transaction-description').value = transaction.description;
            document.querySelector('#transaction-amount').value = transaction.amount;
            document.querySelector('#transaction-type').value = transaction.type;
            document.querySelector('#transaction-wallet').value = transaction.wallet;
            openModal(modal);
        }
    }

    if (deleteButton) {
        const transactionId = Number(deleteButton.dataset.delete);
        const transactionIndex = transactions.findIndex((item) => item.id === transactionId);

        if (transactionIndex !== -1 && window.confirm('Hapus transaksi demo ini?')) {
            transactions.splice(transactionIndex, 1);
            renderTransactions();
            showToast('Transaksi demo berhasil dihapus.');
        }
    }
});

transactionForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const description = document.querySelector('#transaction-description').value.trim();
    const amount = Number(document.querySelector('#transaction-amount').value);

    if (!description || !Number.isSafeInteger(amount) || amount < 1) {
        showToast('Masukkan deskripsi dan nominal rupiah yang valid.');
        return;
    }

    const transaction = {
        id: editingTransactionId ?? Date.now(),
        description,
        date: 'Hari ini, baru saja',
        category: document.querySelector('#transaction-type').value === 'income' ? 'Penjualan' : 'Belanja dagangan',
        wallet: document.querySelector('#transaction-wallet').value,
        amount,
        type: document.querySelector('#transaction-type').value,
        source: 'Teks',
    };

    if (editingTransactionId === null) {
        transactions.unshift(transaction);
    } else {
        const index = transactions.findIndex((item) => item.id === editingTransactionId);

        if (index !== -1) {
            transactions[index] = transaction;
        }
    }

    renderTransactions();
    closeModal(modal);
    showToast(editingTransactionId === null ? 'Transaksi demo tersimpan untuk sesi ini.' : 'Perubahan transaksi demo tersimpan.');
    editingTransactionId = null;
});

document.querySelector('#quick-entry-form').addEventListener('submit', (event) => {
    event.preventDefault();
    const description = document.querySelector('#quick-entry').value.trim();

    if (description) {
        prepareTransaction(description);
    }
});

document.querySelectorAll('[data-voice-example]').forEach((button) => {
    button.addEventListener('click', () => prepareTransaction(button.dataset.voiceExample));
});

document.querySelector('#voice-button').addEventListener('click', () => {
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (!SpeechRecognition) {
        showToast('Pengenalan suara tidak tersedia di browser ini. Gunakan input manual.');
        return;
    }

    if (recognition) {
        recognition.stop();
    }

    recognition = new SpeechRecognition();
    recognition.lang = 'id-ID';
    recognition.interimResults = false;
    recognition.maxAlternatives = 1;
    const button = document.querySelector('#voice-button');
    const state = document.querySelector('#voice-state');
    const hint = document.querySelector('#voice-hint');

    recognition.onstart = () => {
        button.classList.add('is-listening');
        state.textContent = 'Mendengarkan...';
        hint.textContent = 'Ucapkan satu transaksi dengan jelas';
    };

    recognition.onresult = (event) => {
        const description = event.results[0][0].transcript.trim();
        prepareTransaction(description, parseSpokenAmount(description));
        showToast('Periksa deskripsi dan nominal sebelum menyimpan.');
    };

    recognition.onerror = (event) => {
        showToast(event.error === 'not-allowed'
            ? 'Akses mikrofon ditolak. Anda tetap bisa mengetik transaksi.'
            : 'Suara belum tertangkap. Silakan coba lagi atau gunakan input manual.');
    };

    recognition.onend = () => {
        button.classList.remove('is-listening');
        state.textContent = 'Bicara untuk mulai';
        hint.textContent = 'Bahasa Indonesia · Otomatis';
    };

    recognition.start();
});

document.querySelector('#profile-form').addEventListener('submit', (event) => {
    event.preventDefault();
    const shopName = document.querySelector('#shop-name-input').value.trim();

    if (!shopName) {
        showToast('Nama usaha tidak boleh kosong.');
        return;
    }

    document.querySelector('.shop-copy strong').textContent = shopName;
    document.querySelector('.profile-button > span:nth-child(2)').textContent = shopName;
    document.querySelector('.shop-profile h3').textContent = shopName;
    closeModal(onboardingModal);
    showToast('Profil diperbarui untuk sesi demo ini.');
});

document.querySelector('#export-transactions').addEventListener('click', exportCsv);
document.querySelector('#export-backup').addEventListener('click', exportCsv);

document.querySelector('#download-report').addEventListener('click', () => {
    showToast('Gunakan “Simpan sebagai PDF” pada dialog cetak browser.');
    window.setTimeout(() => window.print(), 250);
});

document.querySelector('#clear-data').addEventListener('click', () => {
    if (!window.confirm('Hapus semua transaksi demo dari sesi browser ini?')) {
        return;
    }

    transactions.splice(0, transactions.length);
    renderTransactions();
    showToast('Transaksi demo sudah dihapus dari tampilan ini.');
});

document.querySelectorAll('.toggle-input').forEach((toggle) => {
    toggle.addEventListener('change', () => {
        const settingName = toggle.getAttribute('aria-label');
        showToast(`${settingName} ${toggle.checked ? 'diaktifkan' : 'dinonaktifkan'} untuk sesi demo.`);
    });
});

renderTransactions();
