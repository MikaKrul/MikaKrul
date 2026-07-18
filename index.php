<?php
// DEBUG: Show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mika — Portfolio</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #e8e4df;
    --bg-light: #f0ece7;
    --bg-dark: #d4cfc9;
    --text: #2a2520;
    --text-secondary: #6b6358;
    --accent: #e07a5f;
    --accent-dark: #c45a3f;
    --shadow-light: rgba(255,255,255,0.7);
    --shadow-dark: rgba(0,0,0,0.12);
    --radius: 20px;
    --radius-sm: 14px;
  }
  * { margin:0; padding:0; box-sizing:border-box; }
  html { scroll-behavior: smooth; }
  body {
    font-family: 'Space Grotesk', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    overflow-x: hidden;
  }
  /* Neumorphic utility classes */
  .neu-raised {
    background: var(--bg);
    border-radius: var(--radius);
    box-shadow:
      8px 8px 20px var(--shadow-dark),
      -8px -8px 20px var(--shadow-light);
    transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
  }
  .neu-raised:hover {
    box-shadow:
      12px 12px 28px var(--shadow-dark),
      -12px -12px 28px var(--shadow-light);
    transform: translateY(-2px);
  }
  .neu-raised:active {
    box-shadow:
      4px 4px 10px var(--shadow-dark),
      -4px -4px 10px var(--shadow-light);
    transform: translateY(0);
  }
  .neu-inset {
    background: var(--bg);
    border-radius: var(--radius);
    box-shadow:
      inset 6px 6px 14px var(--shadow-dark),
      inset -6px -6px 14px var(--shadow-light);
  }
  .neu-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    border-radius: var(--radius);
    background: var(--bg);
    border: none;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--text);
    cursor: pointer;
    box-shadow:
      6px 6px 14px var(--shadow-dark),
      -6px -6px 14px var(--shadow-light);
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    text-decoration: none;
  }
  .neu-btn:hover {
    box-shadow:
      10px 10px 24px var(--shadow-dark),
      -10px -10px 24px var(--shadow-light);
    transform: translateY(-3px);
    color: var(--accent-dark);
  }
  .neu-btn:active {
    box-shadow:
      inset 4px 4px 10px var(--shadow-dark),
      inset -4px -4px 10px var(--shadow-light);
    transform: translateY(0);
  }
  .neu-btn.accent {
    background: var(--accent);
    color: #fff;
    box-shadow:
      6px 6px 14px rgba(0,0,0,0.15),
      -6px -6px 14px rgba(255,255,255,0.5);
  }
  .neu-btn.accent:hover {
    background: var(--accent-dark);
    box-shadow:
      10px 10px 24px rgba(0,0,0,0.2),
      -10px -10px 24px rgba(255,255,255,0.6);
  }
  .neu-btn.accent:active {
    box-shadow:
      inset 4px 4px 10px rgba(0,0,0,0.2),
      inset -4px -4px 10px rgba(255,255,255,0.3);
  }

  /* Navigation */
  nav {
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    padding: 20px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(232,228,223,0.85);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255,255,255,0.4);
  }
  .nav-logo {
    font-weight: 700;
    font-size: 1.4rem;
    letter-spacing: -0.5px;
    color: var(--text);
    text-decoration: none;
  }
  .nav-logo span { color: var(--accent-dark); }
  .nav-links {
    display: flex;
    gap: 12px;
    list-style: none;
  }
  .nav-links a {
    text-decoration: none;
    color: var(--text-secondary);
    font-weight: 500;
    font-size: 0.9rem;
    padding: 10px 20px;
    border-radius: var(--radius-sm);
    transition: all 0.3s;
  }
  .nav-links a:hover {
    color: var(--text);
    background: var(--bg);
    box-shadow:
      4px 4px 10px var(--shadow-dark),
      -4px -4px 10px var(--shadow-light);
  }
  .nav-links a.active {
    color: var(--accent-dark);
    background: var(--bg);
    box-shadow:
      inset 3px 3px 8px var(--shadow-dark),
      inset -3px -3px 8px var(--shadow-light);
  }

  /* Hero */
  .hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 120px 40px 80px;
    position: relative;
  }
  .hero-inner {
    max-width: 1100px;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
  }
  .hero-text h1 {
    font-size: 3.6rem;
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: -2px;
    margin-bottom: 20px;
  }
  .hero-text h1 span {
    color: var(--accent-dark);
    position: relative;
  }
  .hero-text .subtitle {
    font-size: 1.25rem;
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 36px;
    max-width: 480px;
  }
  .hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }

  .hero-avatar-wrap {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .hero-avatar {
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: var(--bg);
    box-shadow:
      20px 20px 50px var(--shadow-dark),
      -20px -20px 50px var(--shadow-light),
      inset 2px 2px 6px var(--shadow-light),
      inset -2px -2px 6px var(--shadow-dark);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }
  .hero-avatar::before {
    content: '';
    position: absolute;
    width: 260px;
    height: 260px;
    border-radius: 50%;
    background: var(--bg);
    box-shadow:
      inset 8px 8px 20px var(--shadow-dark),
      inset -8px -8px 20px var(--shadow-light);
  }
  .hero-avatar-inner {
    position: relative;
    z-index: 2;
    font-size: 6rem;
    font-weight: 700;
    color: var(--accent-dark);
    text-shadow: 2px 2px 8px rgba(0,0,0,0.1);
  }

  /* Section styling */
  section { padding: 100px 40px; }
  .section-header {
    text-align: center;
    margin-bottom: 60px;
  }
  .section-header h2 {
    font-size: 2.4rem;
    font-weight: 700;
    letter-spacing: -1px;
    margin-bottom: 12px;
  }
  .section-header p {
    color: var(--text-secondary);
    font-size: 1.1rem;
  }

  /* About / What I'm up to */
  .about-grid {
    max-width: 1000px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
  }
  .about-card {
    padding: 36px 32px;
    border-radius: var(--radius);
    background: var(--bg);
    box-shadow:
      10px 10px 24px var(--shadow-dark),
      -10px -10px 24px var(--shadow-light);
    transition: all 0.35s cubic-bezier(0.4,0,0.2,1);
    position: relative;
    overflow: hidden;
  }
  .about-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: var(--accent);
    border-radius: 2px;
    opacity: 0;
    transition: opacity 0.3s;
  }
  .about-card:hover {
    transform: translateY(-6px);
    box-shadow:
      16px 16px 40px var(--shadow-dark),
      -16px -16px 40px var(--shadow-light);
  }
  .about-card:hover::before { opacity: 1; }
  .about-card .icon {
    width: 56px;
    height: 56px;
    border-radius: var(--radius-sm);
    background: var(--bg);
    box-shadow:
      5px 5px 12px var(--shadow-dark),
      -5px -5px 12px var(--shadow-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: var(--accent-dark);
  }
  .about-card h3 {
    font-size: 1.15rem;
    font-weight: 600;
    margin-bottom: 10px;
  }
  .about-card p {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.6;
  }
  .about-card a {
    color: var(--accent-dark);
    text-decoration: none;
    font-weight: 500;
    border-bottom: 1px solid transparent;
    transition: border-color 0.3s;
  }
  .about-card a:hover { border-bottom-color: var(--accent-dark); }

  .tech-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: rgba(255,255,255,0.5);
  }
  .tech-grid {
    max-width: 900px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 24px;
  }
  .tech-badge {
    padding: 18px 32px;
    border-radius: var(--radius);
    background: var(--bg);
    box-shadow:
      6px 6px 16px var(--shadow-dark),
      -6px -6px 16px var(--shadow-light);
    font-family: 'JetBrains Mono', monospace;
    font-weight: 500;
    font-size: 0.9rem;
    color: var(--text);
    display: flex;
    align-items: center;
    gap: 12px;
    transition: all 0.3s;
    cursor: default;
  }
  .tech-badge:hover {
    transform: translateY(-4px) scale(1.03);
    box-shadow:
      10px 10px 24px var(--shadow-dark),
      -10px -10px 24px var(--shadow-light);
  }
  .tech-badge .dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--accent);
    box-shadow: 0 0 8px var(--accent);
  }

  /* Projects */
  .projects-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
    gap: 36px;
  }
  .project-card {
    padding: 0;
    border-radius: var(--radius);
    background: var(--bg);
    box-shadow:
      12px 12px 30px var(--shadow-dark),
      -12px -12px 30px var(--shadow-light);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
    display: flex;
    flex-direction: column;
  }
  .project-card:hover {
    transform: translateY(-8px);
    box-shadow:
      20px 20px 50px var(--shadow-dark),
      -20px -20px 50px var(--shadow-light);
  }
  .project-visual {
    height: 200px;
    background: var(--bg);
    box-shadow:
      inset 6px 6px 16px var(--shadow-dark),
      inset -6px -6px 16px var(--shadow-light);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
  }
  .project-visual .proj-icon {
    width: 100px;
    height: 100px;
    border-radius: 24px;
    background: var(--bg);
    box-shadow:
      8px 8px 20px var(--shadow-dark),
      -8px -8px 20px var(--shadow-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    position: relative;
    z-index: 2;
  }
  .project-visual .proj-icon::after {
    content: '';
    position: absolute;
    width: 70px;
    height: 70px;
    border-radius: 18px;
    background: var(--bg);
    box-shadow:
      inset 4px 4px 10px var(--shadow-dark),
      inset -4px -4px 10px var(--shadow-light);
    z-index: -1;
  }
  .project-body { padding: 32px; }
  .project-body h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 12px;
  }
  .project-body p {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.65;
    margin-bottom: 20px;
  }
  .project-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 20px;
  }
  .project-tag {
    padding: 6px 14px;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
    font-family: 'JetBrains Mono', monospace;
    background: var(--bg);
    box-shadow:
      3px 3px 8px var(--shadow-dark),
      -3px -3px 8px var(--shadow-light);
    color: var(--text-secondary);
  }
  .project-links { display: flex; gap: 12px; }
  .project-links a {
    padding: 10px 20px;
    border-radius: var(--radius-sm);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s;
  }
  .project-links a.primary {
    background: var(--accent);
    color: #fff;
    box-shadow: 4px 4px 12px rgba(0,0,0,0.15);
  }
  .project-links a.primary:hover {
    background: var(--accent-dark);
    transform: translateY(-2px);
  }
  .project-links a.secondary {
    background: var(--bg);
    color: var(--text);
    box-shadow:
      4px 4px 10px var(--shadow-dark),
      -4px -4px 10px var(--shadow-light);
  }
  .project-links a.secondary:hover {
    box-shadow:
      6px 6px 14px var(--shadow-dark),
      -6px -6px 14px var(--shadow-light);
    transform: translateY(-2px);
  }

  /* Footer */
  footer {
    padding: 60px 40px;
    text-align: center;
    background: var(--bg);
    border-top: 1px solid rgba(255,255,255,0.4);
  }
  footer p {
    color: var(--text-secondary);
    font-size: 0.9rem;
  }
  footer a {
    color: var(--accent-dark);
    text-decoration: none;
    font-weight: 500;
  }

  /* Responsive */
  @media (max-width: 900px) {
    .hero-inner { grid-template-columns: 1fr; text-align: center; }
    .hero-text .subtitle { margin: 0 auto 36px; }
    .hero-actions { justify-content: center; }
    .hero-avatar { width: 240px; height: 240px; }
    .hero-avatar-inner { font-size: 4.5rem; }
    .projects-grid { grid-template-columns: 1fr; }
    nav { padding: 16px 24px; }
    .nav-links { display: none; }
  }

  /* Scroll reveal */
  .reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: all 0.8s cubic-bezier(0.4,0,0.2,1);
  }
  .reveal.visible {
    opacity: 1;
    transform: translateY(0);
  }
</style>
</head>
<body>

<nav>
  <a href="index.php" class="nav-logo">Mika<span>.</span></a>
  <ul class="nav-links">
    <li><a href="index.php" class="active">Home</a></li>
    <li><a href="projects.php">Projects</a></li>
    <li><a href="https://github.com/MikaKrul" target="_blank">GitHub</a></li>
  </ul>
</nav>

<section class="hero">
  <div class="hero-inner">
    <div class="hero-text">
      <h1>Hi there <span>👋</span><br>I'm Mika</h1>
      <p class="subtitle">A tech enthusiast from the Netherlands</p>
      <div class="hero-actions">
        <a href="projects.php" class="neu-btn accent">View Projects</a>
        <a href="https://github.com/MikaKrul" target="_blank" class="neu-btn">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
          GitHub
        </a>
      </div>
    </div>
    <div class="hero-avatar-wrap">
      <div class="hero-avatar">
        <div class="hero-avatar-inner">MK</div>
      </div>
    </div>
  </div>
</section>

<section id="about">
  <div class="section-header reveal">
    <h2>What I'm up to</h2>
    <p>Building, learning, and contributing to the open-source community</p>
  </div>
  <div class="about-grid">
    <div class="about-card reveal">
      <div class="icon">💻</div>
      <h3>Contributing</h3>
      <p>Open-source projects like <a href="https://github.com/handy-computer/handy.computer" target="_blank">handy.computer</a>. Helping build tools that make computing more accessible.</p>
    </div>
    <div class="about-card reveal">
      <div class="icon">🌐</div>
      <h3>Building</h3>
      <p>Custom web applications using PHP, JavaScript, and SQL — like my <a href="https://flashcard.page.gd" target="_blank">school platform</a> for flashcards and learning.</p>
    </div>
    <div class="about-card reveal">
      <div class="icon">🤖</div>
      <h3>Experimenting</h3>
      <p>Currently playing around with local AI models and exploring the inner workings of desktop applications.</p>
    </div>
    <div class="about-card reveal">
      <div class="icon">📚</div>
      <h3>Learning</h3>
      <p>Deep-diving into the inner workings of desktop applications and expanding my understanding of systems-level programming.</p>
    </div>
  </div>
</section>

<section id="projects">
  <div class="section-header reveal">
    <h2>Featured Projects</h2>
    <p>A glimpse of what I've been building</p>
  </div>
  <div class="projects-grid">
    <!-- Image Tools -->
    <div class="project-card reveal">
      <div class="project-visual">
        <div class="proj-icon">🖼️</div>
      </div>
      <div class="project-body">
        <h3>Image Tools</h3>
        <p>A browser extension that adds image conversion, reverse search, and sharing options to the right-click context menu. Convert web images locally into PNG, JPEG, PDF, AVIF, and more.</p>
        <div class="project-tags">
          <span class="project-tag">Manifest V3</span>
          <span class="project-tag">Chrome</span>
          <span class="project-tag">Firefox</span>
          <span class="project-tag">JavaScript</span>
        </div>
        <div class="project-links">
          <a href="https://github.com/MikaKrul" target="_blank" class="primary">View on GitHub</a>
          <a href="projects.php" class="secondary">All Projects</a>
        </div>
      </div>
    </div>
    <!-- Click & Bookmark -->
    <div class="project-card reveal">
      <div class="project-visual">
        <div class="proj-icon">⭐</div>
      </div>
      <div class="project-body">
        <h3>Click & Bookmark</h3>
        <p>A lightweight, distraction-free browser extension that lets you instantly save any webpage to your native browser bookmark folders directly via the right-click context menu.</p>
        <div class="project-tags">
          <span class="project-tag">Chrome API</span>
          <span class="project-tag">Bookmarks</span>
          <span class="project-tag">Privacy-First</span>
        </div>
        <div class="project-links">
          <a href="https://github.com/MikaKrul" target="_blank" class="primary">View on GitHub</a>
          <a href="projects.php" class="secondary">All Projects</a>
        </div>
      </div>
    </div>
  </div>
</section>

<footer>
  <p>Built with care by <a href="https://github.com/MikaKrul" target="_blank">Mika</a> · Netherlands · 2026</p>
</footer>

<script>
  // Scroll reveal
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, { threshold: 0.1 });
  reveals.forEach(el => observer.observe(el));

  // Active nav link
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-links a');
  window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      if (scrollY >= sectionTop - 200) current = section.getAttribute('id');
    });
    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href') === '#' + current) link.classList.add('active');
    });
  });
</script>

</body>
</html>
