<?php
// ============================================================
// Mika Portfolio — Projects Page
// Neumorphic design with warm clay palette
// ============================================================

// DEBUG: Show all errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$projects = [
    [
        'name'        => 'Image Tools',
        'icon'        => '🖼️',
        'tagline'     => 'Browser extension for image conversion, reverse search, and sharing.',
        'readme'      => 'A browser extension that adds image conversion, reverse search, and sharing options to the right-click context menu.

## Features

### Local Image Conversion
Convert web images directly into different formats. Processing happens locally in the browser.
* Supported Formats: PNG, JPEG, PDF, AVIF, BMP, GIF, TIFF, ICO, WebP.
* Advanced Options: Configure compression quality for lossy formats and set filename prefixes or subfolders for downloads.

### Reverse Search
Look up images using search engines.
* Integrations: Google Lens, Lenso.ai, Bing Visual Search, Yandex, Baidu, Sogou, TinEye, Shutterstock.

### Social Sharing
Share images to social platforms or copy them for development use.
* Platforms: WhatsApp, X (Twitter), Windows Native Share, Telegram, Reddit, Signal, Facebook.
* Developer Tools: Copy an image as a Base64 Data URL to the clipboard.

### User Interface
The extension includes a popup and a settings dashboard to configure preferences.
* Drag and drop items to reorder the context menu.
* Light and Dark mode options.
* Option to group all features under a single parent menu.

## Installation (Developer Mode)

This extension uses Manifest V3 and can be loaded into Chromium-based browsers:

1. Clone or download this repository.
2. Open your browser and navigate to the extensions page (chrome://extensions/).
3. Enable Developer mode.
4. Click on Load unpacked.
5. Select the folder containing the manifest.json file.
6. Right-click any image to view the new context menu options.

### Firefox (Developer Mode)

1. Clone or download this repository.
2. Open Firefox and navigate to `about:debugging#/runtime/this-firefox`.
3. Click on **Load Temporary Add-on...**
4. Select any file in the folder (e.g., `manifest.json`).
5. Right-click any image to view the new context menu options.

## Privacy Policy
This extension does not track users or collect data. All image conversions happen locally on the device. Read PRIVACY_POLICY.md for more information.

## License
MIT License.',
        'tags'        => ['Manifest V3', 'Chrome', 'Firefox', 'JavaScript'],
        'github_url'  => 'https://github.com/MikaKrul/imagetools',
    ],
    [
        'name'        => 'Click & Bookmark',
        'icon'        => '⭐',
        'tagline'     => 'Lightweight browser extension to save webpages via right-click context menu.',
        'readme'      => 'A lightweight, distraction-free browser extension that lets you instantly save any webpage to your native browser bookmark folders directly via the right-click context menu.

## Features

- **Context-Menu Integration:** Right-click anywhere on a webpage to instantly save it.
- **Dynamic Folder Tree:** Automatically fetches your native browser bookmark folders (including Bookmark Bar, Other Bookmarks, and nested subfolders).
- **Subfolder Visual Depth:** Nested folders are beautifully indented using clean visual markers (` — `).
- **Real-time Sync:** Dynamically syncs and rebuilds the menu whenever you add, rename, move, or delete folders in your browser\'s native bookmark manager.
- **Settings Popup:** Configure your experience with a beautiful settings panel:
  - **System Folders Toggle:** Show or hide standard roots (like *Bookmarks Bar* or *Other Bookmarks*) to only display your custom folders.
  - **Save Notifications:** Toggle instant native notifications when a bookmark is successfully saved.
- **Privacy-First & Lightweight:** No background tracking, no external storage, and no cloud databases. It uses Chrome\'s native API.

## Design Details

The extension\'s interface and icon are tailored to match the default Helium and Chromium browser toolbars:
- **Icon:** A geometric, outline-style star matching the exact `1.5px` stroke thickness used by the browser\'s native UI icons.
- **Settings UI:** A premium, dark-mode configuration panel with gold accent highlights matching Chrome\'s native bookmark star color.

## Installation (Developer Mode)

Since this extension is optimized for personal use, you can easily load it locally into your browser:

1. Download the latest release to your computer and un-zip it.
2. Open your browser and navigate to the Extensions page (`chrome://extensions`) or your specific browser\'s extension page.
3. Enable **Developer mode** (usually a toggle switch in the top-right corner).
4. Click on **Load unpacked** (top-left corner).
5. Select the folder containing the extension files (where `manifest.json` is located).

## Repository Structure

```text
├── manifest.json    # Extension configuration and native permissions
├── background.js    # Background service worker handling context menus, storage, and notifications
├── popup.html       # Beautiful settings popup panel UI
├── popup.js         # Settings logic, storage management, and version rendering
├── README.md        # Documentation
├── privacy.md       # Privacy Policy
└── icons/           # Icon files for different sizes
    ├── icon-16.png
    ├── icon-32.png
    ├── icon-48.png
    ├── icon-128.png
    ├── icon-256.png
    └── icon-512.png
```',
        'tags'        => ['Chrome API', 'Bookmarks', 'Privacy-First', 'Helium UI'],
        'github_url'  => 'https://github.com/MikaKrul/click-bookmark',
    ],
];

function renderMarkdown($text) {
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    // Headers
    $text = preg_replace('/^#{6}[ \t]+(.+)$/m', '<h6>$1</h6>', $text);
    $text = preg_replace('/^#{5}[ \t]+(.+)$/m', '<h5>$1</h5>', $text);
    $text = preg_replace('/^#{4}[ \t]+(.+)$/m', '<h4>$1</h4>', $text);
    $text = preg_replace('/^#{3}[ \t]+(.+)$/m', '<h3>$1</h3>', $text);
    $text = preg_replace('/^#{2}[ \t]+(.+)$/m', '<h2>$1</h2>', $text);
    $text = preg_replace('/^#{1}[ \t]+(.+)$/m', '<h1>$1</h1>', $text);
    // Bold / Italic
    $text = preg_replace('/\*\*\*(.+?)\*\*\*/', '<strong><em>$1</em></strong>', $text);
    $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*(.+?)\*/', '<em>$1</em>', $text);
    // Inline code
    $text = preg_replace('/`([^`]+)`/', '<code>$1</code>', $text);
    // Code blocks
    $text = preg_replace('/```text\n(.*?)```/s', '<pre class="code-block"><code>$1</code></pre>', $text);
    $text = preg_replace('/```\n(.*?)```/s', '<pre class="code-block"><code>$1</code></pre>', $text);
    // Lists
    $text = preg_replace('/^\*[ \t]+(.+)$/m', '<li>$1</li>', $text);
    $text = preg_replace('/^-[ \t]+(.+)$/m', '<li>$1</li>', $text);
    // Links
    $text = preg_replace('/\[([^\]]+)\]\(([^)]+)\)/', '<a href="$2" target="_blank">$1</a>', $text);
    // Paragraphs
    $text = preg_replace('/\n\n+/', '</p><p>', $text);
    $text = '<p>' . $text . '</p>';
    // Clean up empty paragraphs
    $text = str_replace('<p></p>', '', $text);
    // Wrap loose li in ul
    $text = preg_replace('/(<li>.*?<\/li>\s*)+/', '<ul>$0</ul>', $text);
    return $text;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Projects — Mika</title>
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
    line-height: 1.6;
  }

  /* Neumorphic utilities */
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
  .neu-btn.small {
    padding: 10px 22px;
    font-size: 0.85rem;
    border-radius: var(--radius-sm);
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
    min-height: 40vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 140px 40px 60px;
    text-align: center;
  }
  .hero h1 {
    font-size: 3rem;
    font-weight: 700;
    letter-spacing: -1.5px;
    margin-bottom: 12px;
  }
  .hero h1 span { color: var(--accent-dark); }
  .hero p {
    color: var(--text-secondary);
    font-size: 1.15rem;
    max-width: 500px;
    margin: 0 auto;
  }

  /* Project cards */
  .projects-section { padding: 40px 40px 100px; }
  .projects-grid {
    max-width: 1100px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(480px, 1fr));
    gap: 36px;
  }
  .project-card {
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
    transform: translateY(-6px);
    box-shadow:
      18px 18px 45px var(--shadow-dark),
      -18px -18px 45px var(--shadow-light);
  }
  .project-header {
    padding: 36px 36px 24px;
    display: flex;
    align-items: flex-start;
    gap: 20px;
    border-bottom: 1px solid rgba(0,0,0,0.04);
  }
  .project-icon {
    width: 72px;
    height: 72px;
    border-radius: var(--radius-sm);
    background: var(--bg);
    box-shadow:
      6px 6px 14px var(--shadow-dark),
      -6px -6px 14px var(--shadow-light);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    flex-shrink: 0;
  }
  .project-title-wrap { flex: 1; }
  .project-title-wrap h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 6px;
    letter-spacing: -0.5px;
  }
  .project-title-wrap .tagline {
    color: var(--text-secondary);
    font-size: 0.95rem;
    line-height: 1.5;
  }
  .project-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 14px;
  }
  .project-tag {
    padding: 5px 14px;
    border-radius: 10px;
    font-size: 0.72rem;
    font-weight: 600;
    font-family: 'JetBrains Mono', monospace;
    background: var(--bg);
    box-shadow:
      3px 3px 8px var(--shadow-dark),
      -3px -3px 8px var(--shadow-light);
    color: var(--text-secondary);
  }

  /* README section */
  .readme-section {
    padding: 28px 36px 36px;
    flex: 1;
  }
  .readme-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: var(--radius-sm);
    background: var(--bg);
    box-shadow:
      4px 4px 10px var(--shadow-dark),
      -4px -4px 10px var(--shadow-light);
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--text);
    cursor: pointer;
    border: none;
    transition: all 0.3s;
    margin-bottom: 20px;
  }
  .readme-toggle:hover {
    box-shadow:
      6px 6px 14px var(--shadow-dark),
      -6px -6px 14px var(--shadow-light);
    color: var(--accent-dark);
  }
  .readme-toggle .chevron {
    transition: transform 0.3s;
    display: inline-block;
  }
  .readme-toggle.open .chevron { transform: rotate(180deg); }
  .readme-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s cubic-bezier(0.4,0,0.2,1), opacity 0.4s;
    opacity: 0;
  }
  .readme-content.open {
    max-height: 2000px;
    opacity: 1;
  }
  .readme-inner {
    padding: 24px;
    border-radius: var(--radius-sm);
    background: var(--bg);
    box-shadow:
      inset 5px 5px 12px var(--shadow-dark),
      inset -5px -5px 12px var(--shadow-light);
    font-size: 0.9rem;
    line-height: 1.7;
    color: var(--text-secondary);
  }
  .readme-inner h1, .readme-inner h2, .readme-inner h3,
  .readme-inner h4, .readme-inner h5, .readme-inner h6 {
    color: var(--text);
    margin: 1.2em 0 0.6em;
    font-weight: 600;
  }
  .readme-inner h1 { font-size: 1.3rem; }
  .readme-inner h2 { font-size: 1.1rem; }
  .readme-inner h3 { font-size: 1rem; }
  .readme-inner p { margin-bottom: 1em; }
  .readme-inner ul {
    margin: 0.8em 0 0.8em 1.2em;
    padding: 0;
  }
  .readme-inner li {
    margin-bottom: 0.4em;
    list-style-type: disc;
  }
  .readme-inner code {
    font-family: 'JetBrains Mono', monospace;
    background: rgba(0,0,0,0.04);
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 0.85em;
    color: var(--accent-dark);
  }
  .readme-inner pre.code-block {
    background: rgba(0,0,0,0.04);
    padding: 16px;
    border-radius: 10px;
    overflow-x: auto;
    margin: 1em 0;
  }
  .readme-inner pre.code-block code {
    background: none;
    padding: 0;
    font-size: 0.8rem;
    line-height: 1.6;
    color: var(--text);
  }
  .readme-inner a {
    color: var(--accent-dark);
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: border-color 0.3s;
  }
  .readme-inner a:hover { border-bottom-color: var(--accent-dark); }
  .readme-inner strong { color: var(--text); }

  /* GitHub CTA */
  .project-footer {
    padding: 0 36px 36px;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
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
    .projects-grid { grid-template-columns: 1fr; }
    .hero h1 { font-size: 2.2rem; }
    nav { padding: 16px 24px; }
    .nav-links { display: none; }
    .project-header { flex-direction: column; align-items: center; text-align: center; }
    .project-tags { justify-content: center; }
    .project-footer { justify-content: center; }
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
    <li><a href="index.php">Home</a></li>
    <li><a href="projects.php" class="active">Projects</a></li>
    <li><a href="https://github.com/MikaKrul" target="_blank">GitHub</a></li>
  </ul>
</nav>

<section class="hero">
  <div>
    <h1>My <span>Projects</span></h1>
    <p>Browser extensions and tools built with care. Each one solves a real problem I ran into.</p>
  </div>
</section>

<section class="projects-section">
  <div class="projects-grid">
    <?php foreach ($projects as $i => $project): ?>
    <article class="project-card reveal" style="transition-delay: <?php echo $i * 0.1; ?>s">
      <div class="project-header">
        <div class="project-icon"><?php echo $project['icon']; ?></div>
        <div class="project-title-wrap">
          <h2><?php echo htmlspecialchars($project['name']); ?></h2>
          <p class="tagline"><?php echo htmlspecialchars($project['tagline']); ?></p>
          <div class="project-tags">
            <?php foreach ($project['tags'] as $tag): ?>
            <span class="project-tag"><?php echo htmlspecialchars($tag); ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div class="readme-section">
        <button class="readme-toggle" onclick="toggleReadme(this)">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
          README.md
        </button>
        <div class="readme-content">
          <div class="readme-inner">
            <?php echo renderMarkdown($project['readme']); ?>
          </div>
        </div>
      </div>

      <div class="project-footer">
        <a href="<?php echo htmlspecialchars($project['github_url']); ?>" target="_blank" class="neu-btn accent small">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
          View on GitHub
        </a>
        <a href="<?php echo htmlspecialchars($project['github_url']); ?>" target="_blank" class="neu-btn small">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4"/><polyline points="14 2 14 8 20 8"/><path d="M2 15h10"/><path d="M5 12l-3 3 3 3"/></svg>
          Source Code
        </a>
      </div>
    </article>
    <?php endforeach; ?>
  </div>
</section>

<footer>
  <p><a href="https://github.com/MikaKrul" target="_blank">Mika</a> · Netherlands · 2026</p>
</footer>

<script>
  function toggleReadme(btn) {
    const content = btn.nextElementSibling;
    const isOpen = content.classList.contains('open');
    content.classList.toggle('open');
    btn.classList.toggle('open');
    // Close other open readmes
    document.querySelectorAll('.readme-content.open').forEach(el => {
      if (el !== content) {
        el.classList.remove('open');
        el.previousElementSibling.classList.remove('open');
      }
    });
  }

  // Scroll reveal
  const reveals = document.querySelectorAll('.reveal');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) entry.target.classList.add('visible');
    });
  }, { threshold: 0.1 });
  reveals.forEach(el => observer.observe(el));
</script>

</body>
</html>
