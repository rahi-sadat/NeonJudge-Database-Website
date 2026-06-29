const navToggle = document.querySelector('[data-nav-toggle]');
const navLinks = document.querySelector('[data-nav-links]');

if (navToggle && navLinks) {
    navToggle.setAttribute('aria-expanded', 'false');

    navToggle.addEventListener('click', () => {
        const isOpen = navLinks.classList.toggle('open');
        navToggle.setAttribute('aria-expanded', String(isOpen));
    });

    navLinks.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            navLinks.classList.remove('open');
            navToggle.setAttribute('aria-expanded', 'false');
        });
    });
}

document.querySelectorAll('[data-filter]').forEach((button) => {
    button.addEventListener('click', () => {
        const filter = button.dataset.filter;
        document.querySelectorAll('[data-filter]').forEach((item) => item.classList.remove('active'));
        button.classList.add('active');

        document.querySelectorAll('[data-contest-table] tbody tr').forEach((row) => {
            row.style.display = filter === 'All' || row.dataset.status === filter ? '' : 'none';
        });
    });
});

const problemSearch = document.querySelector('[data-problem-search]');
const problemFilter = document.querySelector('[data-problem-filter]');
const problemSort = document.querySelector('[data-problem-sort]');
const problemList = document.querySelector('[data-problem-list]');

function refreshProblems() {
    if (!problemList) return;

    const search = (problemSearch?.value || '').toLowerCase();
    const difficulty = problemFilter?.value || 'All';
    const cards = [...problemList.querySelectorAll('.problem-card')];

    cards.forEach((card) => {
        const matchesSearch = card.dataset.title.includes(search);
        const matchesDifficulty = difficulty === 'All' || card.dataset.difficulty === difficulty;
        card.style.display = matchesSearch && matchesDifficulty ? '' : 'none';
    });

    cards.sort((a, b) => {
        if (problemSort?.value === 'difficulty') {
            return a.dataset.difficulty.localeCompare(b.dataset.difficulty);
        }
        return Number(a.dataset.rating) - Number(b.dataset.rating);
    }).forEach((card) => problemList.appendChild(card));
}

[problemSearch, problemFilter, problemSort].forEach((control) => control?.addEventListener('input', refreshProblems));

document.querySelectorAll('[data-judge-form]').forEach((form) => {
    form.addEventListener('submit', () => {
        const button = form.querySelector('[data-judge-submit]');
        const status = form.querySelector('[data-judge-status]');

        if (button) {
            button.disabled = true;
            button.textContent = 'Judging...';
        }

        if (status) {
            status.className = 'judge-inline-status judge-status-judging';
            status.innerHTML = `
                <span class="judge-status-dot"></span>
                <span>
                    <strong>Judging...</strong>
                    <small>Running your code against Judge0.</small>
                </span>
            `;
        }
    });
});

document.querySelectorAll('[data-sort-leaderboard]').forEach((button) => {
    button.addEventListener('click', () => {
        document.querySelectorAll('[data-sort-leaderboard]').forEach((item) => item.classList.remove('active'));
        button.classList.add('active');

        const tbody = document.querySelector('[data-leaderboard-table] tbody');
        const key = button.dataset.sortLeaderboard;
        const rows = [...tbody.querySelectorAll('tr')];

        rows.sort((a, b) => {
            const aValue = Number(a.querySelector(`[data-${key}]`)?.dataset[key]);
            const bValue = Number(b.querySelector(`[data-${key}]`)?.dataset[key]);
            return key === 'penalty' ? aValue - bValue : bValue - aValue;
        }).forEach((row, index) => {
            row.children[0].textContent = `#${index + 1}`;
            row.classList.toggle('top-rank', index < 3);
            tbody.appendChild(row);
        });
    });
});
