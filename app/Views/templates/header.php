<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- SEO -->
  <title><?= esc($pageTitle ?? 'Tasks for Today') ?> — IT0049 Summative 1</title>
  <meta name="description" content="Tasks for Today Management System — IT0049 Technical Summative Assessment 1 by Brent Verdera." />

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />

  <style>
    /* ── Reset & base ──────────────────────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --bg:          #0f1117;
      --surface:     #1a1d27;
      --surface2:    #232738;
      --border:      #2e3248;
      --accent:      #6c63ff;
      --accent2:     #a78bfa;
      --text:        #e2e8f0;
      --muted:       #8892a4;
      --success:     #34d399;
      --warning:     #fbbf24;
      --info:        #60a5fa;
      --radius:      12px;
      --radius-sm:   8px;
      --shadow:      0 4px 24px rgba(0,0,0,.45);
      --nav-h:       64px;
    }

    html { scroll-behavior: smooth; }

    body {
      font-family: 'Inter', system-ui, sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      line-height: 1.6;
    }

    /* ── Navbar ────────────────────────────────────────────────────────────── */
    .navbar {
      position: sticky;
      top: 0;
      z-index: 100;
      height: var(--nav-h);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
      background: rgba(26,29,39,.85);
      backdrop-filter: blur(14px);
      border-bottom: 1px solid var(--border);
    }

    .nav-brand {
      display: flex;
      align-items: center;
      gap: .6rem;
      text-decoration: none;
      font-weight: 700;
      font-size: 1.1rem;
      color: var(--text);
      letter-spacing: -.02em;
    }

    .nav-brand .dot {
      width: 10px; height: 10px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      box-shadow: 0 0 8px var(--accent);
      animation: pulse 2.5s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; transform: scale(1); }
      50%       { opacity: .6; transform: scale(.85); }
    }

    .nav-links { display: flex; gap: .25rem; list-style: none; }

    .nav-links a {
      display: block;
      padding: .45rem .9rem;
      border-radius: var(--radius-sm);
      text-decoration: none;
      color: var(--muted);
      font-size: .875rem;
      font-weight: 500;
      transition: background .2s, color .2s;
    }

    .nav-links a:hover,
    .nav-links a.active {
      background: var(--surface2);
      color: var(--text);
    }

    .nav-links a.active { color: var(--accent2); }

    /* ── Main container ────────────────────────────────────────────────────── */
    .container {
      max-width: 1000px;
      margin: 0 auto;
      padding: 2.5rem 1.5rem 4rem;
    }

    /* ── Page heading ──────────────────────────────────────────────────────── */
    .page-header {
      margin-bottom: 2rem;
      padding-bottom: 1.25rem;
      border-bottom: 1px solid var(--border);
    }

    .page-header h1 {
      font-size: 1.85rem;
      font-weight: 700;
      letter-spacing: -.03em;
      background: linear-gradient(135deg, #fff 30%, var(--accent2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .page-header .subtitle {
      margin-top: .4rem;
      color: var(--muted);
      font-size: .9rem;
    }

    /* ── Status badges ─────────────────────────────────────────────────────── */
    .badge {
      display: inline-block;
      padding: .2rem .65rem;
      border-radius: 999px;
      font-size: .75rem;
      font-weight: 600;
      letter-spacing: .02em;
      text-transform: uppercase;
    }

    .badge-pending     { background: rgba(251,191,36,.15); color: var(--warning); }
    .badge-in-progress { background: rgba(96,165,250,.15);  color: var(--info); }
    .badge-done        { background: rgba(52,211,153,.15);  color: var(--success); }

    /* ── Task table ────────────────────────────────────────────────────────── */
    .task-table {
      width: 100%;
      border-collapse: collapse;
      background: var(--surface);
      border-radius: var(--radius);
      overflow: hidden;
      box-shadow: var(--shadow);
    }

    .task-table th {
      background: var(--surface2);
      color: var(--muted);
      font-size: .75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: .07em;
      padding: .85rem 1.2rem;
      text-align: left;
    }

    .task-table td {
      padding: .95rem 1.2rem;
      border-top: 1px solid var(--border);
      font-size: .9rem;
      color: var(--text);
      vertical-align: middle;
    }

    .task-table tr:last-child td { border-bottom: none; }

    .task-table tbody tr {
      transition: background .15s;
    }

    .task-table tbody tr:hover { background: var(--surface2); }

    /* ── Empty state ───────────────────────────────────────────────────────── */
    .empty-state {
      text-align: center;
      padding: 3.5rem 1rem;
      background: var(--surface);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
    }

    .empty-icon-box {
      width: 54px;
      height: 54px;
      margin: 0 auto 1.25rem;
      border-radius: 50%;
      background: var(--surface2);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--accent2);
      border: 1px solid var(--border);
    }

    .empty-state h2 {
      font-size: 1.25rem;
      font-weight: 600;
      margin-bottom: .5rem;
    }

    .empty-state p { color: var(--muted); font-size: .9rem; }

    .empty-state code {
      display: inline-block;
      margin-top: .75rem;
      background: var(--surface2);
      color: var(--accent2);
      padding: .35rem .75rem;
      border-radius: var(--radius-sm);
      font-size: .8rem;
      font-family: monospace;
    }

    /* ── Profile card ──────────────────────────────────────────────────────── */
    .profile-card {
      background: var(--surface);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      padding: 2.5rem;
      display: flex;
      align-items: center;
      gap: 2rem;
      border: 1px solid var(--border);
    }

    .profile-avatar {
      flex-shrink: 0;
      width: 90px; height: 90px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent), var(--accent2));
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.2rem;
      font-weight: 700;
      color: #fff;
      box-shadow: 0 0 24px rgba(108,99,255,.4);
    }

    .profile-info h2 {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: .3rem;
    }

    .profile-meta {
      list-style: none;
      margin-top: .75rem;
      display: flex;
      flex-direction: column;
      gap: .4rem;
    }

    .profile-meta li { color: var(--muted); font-size: .9rem; }

    .profile-meta li strong { color: var(--text); margin-right: .35rem; }

    /* ── About / static cards ──────────────────────────────────────────────── */
    .about-card {
      background: var(--surface);
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      border: 1px solid var(--border);
      padding: 2rem;
      margin-bottom: 1.25rem;
    }

    .about-card h2 {
      font-size: 1.1rem;
      font-weight: 700;
      margin-bottom: .75rem;
      color: var(--accent2);
    }

    .about-card p, .about-card li {
      color: var(--muted);
      font-size: .9rem;
      margin-bottom: .4rem;
    }

    .about-card li { margin-left: 1.25rem; }

    /* ── Summary chips ─────────────────────────────────────────────────────── */
    .summary-row {
      display: flex;
      gap: 1rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }

    .chip {
      flex: 1;
      min-width: 120px;
      background: var(--surface);
      border-radius: var(--radius);
      border: 1px solid var(--border);
      padding: 1.1rem 1.4rem;
      box-shadow: var(--shadow);
    }

    .chip .chip-label {
      font-size: .7rem;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: var(--muted);
      font-weight: 600;
    }

    .chip .chip-value {
      font-size: 1.8rem;
      font-weight: 700;
      margin-top: .15rem;
    }

    /* ── Footer ────────────────────────────────────────────────────────────── */
    .site-footer {
      text-align: center;
      padding: 1.5rem;
      border-top: 1px solid var(--border);
      color: var(--muted);
      font-size: .8rem;
    }

    @media (max-width: 640px) {
      .profile-card { flex-direction: column; text-align: center; }
      .profile-meta { align-items: center; }
    }
  </style>
</head>
<body>

<!-- ── Navigation ─────────────────────────────────────────────────────────── -->
<nav class="navbar">
  <a href="<?= base_url('/') ?>" class="nav-brand">
    <span class="dot"></span>
    Tasks for Today
  </a>
  <ul class="nav-links">
    <li><a href="<?= base_url('/') ?>"        <?= (current_url() === base_url('/'))        ? 'class="active"' : '' ?>>Home</a></li>
    <li><a href="<?= base_url('/tasks') ?>"   <?= str_ends_with(current_url(), '/tasks')   ? 'class="active"' : '' ?>>All Tasks</a></li>
    <li><a href="<?= base_url('/profile') ?>" <?= str_ends_with(current_url(), '/profile') ? 'class="active"' : '' ?>>Profile</a></li>
    <li><a href="<?= base_url('/about') ?>"   <?= str_ends_with(current_url(), '/about')   ? 'class="active"' : '' ?>>About</a></li>
  </ul>
</nav>

<main class="container">
