const codeCanvas = document.querySelector('[data-code-rain]');
const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

if (codeCanvas && !prefersReducedMotion) {
    const context = codeCanvas.getContext('2d');
    const glyphs = ['0', '1', '{', '}', '<', '>', '/', '#', '$', 'AC', 'WA', 'TLE', 'SQL', 'JOIN', 'RUN'];
    let columns = [];
    let width = 0;
    let height = 0;
    const fontSize = 15;

    function resizeCodeCanvas() {
        width = codeCanvas.width = window.innerWidth;
        height = codeCanvas.height = window.innerHeight;
        const count = Math.ceil(width / fontSize);
        columns = Array.from({ length: count }, () => Math.random() * height);
    }

    function drawCodeRain() {
        context.fillStyle = 'rgba(5, 6, 12, 0.16)';
        context.fillRect(0, 0, width, height);
        context.font = `${fontSize}px Cascadia Code, Consolas, monospace`;

        columns.forEach((y, index) => {
            const text = glyphs[Math.floor(Math.random() * glyphs.length)];
            const x = index * fontSize;
            const accent = index % 3 === 0 ? '139, 92, 246' : index % 3 === 1 ? '52, 211, 153' : '59, 130, 246';
            context.fillStyle = `rgba(${accent}, ${0.35 + Math.random() * 0.45})`;
            context.fillText(text, x, y);

            columns[index] = y > height + Math.random() * 800 ? 0 : y + fontSize;
        });

        window.requestAnimationFrame(drawCodeRain);
    }

    resizeCodeCanvas();
    drawCodeRain();
    window.addEventListener('resize', resizeCodeCanvas);
}

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

const revealTargets = document.querySelectorAll('.hero, .page-header, .section, .card, .table-wrap, .judge-console');

if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });

    revealTargets.forEach((item) => {
        item.classList.add('reveal');
        observer.observe(item);
    });
} else {
    revealTargets.forEach((item) => item.classList.add('visible'));
}

document.querySelectorAll('a[href]').forEach((link) => {
    link.addEventListener('click', (event) => {
        const isModified = event.metaKey || event.ctrlKey || event.shiftKey || event.altKey;
        const target = link.getAttribute('target');
        const href = link.getAttribute('href');

        if (isModified || target || !href || href.startsWith('#')) {
            return;
        }

        const nextUrl = new URL(link.href, window.location.href);

        if (nextUrl.origin !== window.location.origin || link.hasAttribute('download')) {
            return;
        }

        if (nextUrl.pathname === window.location.pathname && nextUrl.hash) {
            return;
        }

        event.preventDefault();
        document.body.classList.add('is-leaving');
        window.setTimeout(() => {
            window.location.href = nextUrl.href;
        }, 160);
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

const submissionForm = document.querySelector('[data-submission-form]');
const verdictLabel = document.querySelector('[data-verdict-label]');

if (submissionForm && verdictLabel) {
    submissionForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const verdicts = ['Accepted', 'Wrong Answer', 'Time Limit Exceeded', 'Compilation Error'];
        verdictLabel.textContent = 'Pending';
        verdictLabel.style.color = 'var(--violet-bright)';

        setTimeout(() => {
            const verdict = verdicts[Math.floor(Math.random() * verdicts.length)];
            verdictLabel.textContent = verdict;
            verdictLabel.style.color = verdict === 'Accepted' ? 'var(--green-bright)' : 'var(--rose)';
        }, 1400);
    });
}

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
