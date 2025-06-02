<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Select Language</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
    }

    #languageBtn {
      margin: 30px;
      padding: 12px 24px;
      font-size: 16px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    #languageBtn img {
      width: 24px;
      height: 16px;
      border-radius: 2px;
    }

    .modal {
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.6);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal.active {
      display: flex;
    }

    .modal-content {
      background: white;
      max-width: 800px;
      width: 90%;
      padding: 30px;
      border-radius: 12px;
      position: relative;
    }

    .modal h2 {
      margin-top: 0;
      text-align: center;
    }

    .close-btn {
      position: absolute;
      right: 20px;
      top: 16px;
      font-size: 24px;
      cursor: pointer;
    }

    .language-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
      gap: 16px;
      margin-top: 20px;
    }

    .language-item {
      text-align: center;
      padding: 10px;
      border-radius: 6px;
      background: #f9f9f9;
      cursor: pointer;
      transition: background 0.2s;
    }

    .language-item:hover {
      background: #efefef;
    }

    .language-item img {
      width: 32px;
      height: 20px;
      margin-bottom: 6px;
      border-radius: 2px;
    }

    #google_translate_element {
      display: none;
    }
  </style>
</head>
<body>



<button id="languageBtn">
  <img src="https://flagcdn.com/w40/gb.png" id="selectedFlag" alt="Selected Language">
  🌐 Choose Language
</button>

 <!-- Your Website Content -->
  <h1>Welcome to My Website</h1>
  <p>This is a multilingual website that supports automatic translation.</p>
  <button>Click Here</button>




<div class="modal" id="languageModal">
  <div class="modal-content">
    <span class="close-btn" id="closeBtn">&times;</span>
    <h2>Select Language</h2>
    <div class="language-grid" id="languageGrid"></div>
  </div>
</div>

<!-- Google Translate -->
<div id="google_translate_element"></div>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,fr,de,es,hi,zh-CN,ar,ru,it,ja,pt,ko,tr,nl,pl',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>

<script>
  const languages = [
    { code: 'en', name: 'English', flag: 'gb' },
    { code: 'fr', name: 'French', flag: 'fr' },
    { code: 'de', name: 'German', flag: 'de' },
    { code: 'es', name: 'Spanish', flag: 'es' },
    { code: 'hi', name: 'Hindi', flag: 'in' },
    { code: 'zh-CN', name: 'Chinese', flag: 'cn' },
    { code: 'ar', name: 'Arabic', flag: 'sa' },
    { code: 'ru', name: 'Russian', flag: 'ru' },
    { code: 'it', name: 'Italian', flag: 'it' },
    { code: 'ja', name: 'Japanese', flag: 'jp' },
    { code: 'pt', name: 'Portuguese', flag: 'pt' },
    { code: 'ko', name: 'Korean', flag: 'kr' },
    { code: 'tr', name: 'Turkish', flag: 'tr' },
    { code: 'nl', name: 'Dutch', flag: 'nl' },
    { code: 'pl', name: 'Polish', flag: 'pl' }
  ];

  const modal = document.getElementById('languageModal');
  const openBtn = document.getElementById('languageBtn');
  const closeBtn = document.getElementById('closeBtn');
  const languageGrid = document.getElementById('languageGrid');
  const selectedFlag = document.getElementById('selectedFlag');

  openBtn.onclick = () => modal.classList.add('active');
  closeBtn.onclick = () => modal.classList.remove('active');
  window.onclick = e => { if (e.target === modal) modal.classList.remove('active'); };

  function waitForTranslateSelect(callback) {
    const interval = setInterval(() => {
      const select = document.querySelector('select.goog-te-combo');
      if (select) {
        clearInterval(interval);
        callback(select);
      }
    }, 100);
  }

  function createLanguageItem(lang) {
    const div = document.createElement('div');
    div.className = 'language-item';
    div.innerHTML = `
      <img src="https://flagcdn.com/w40/${lang.flag}.png" alt="${lang.name} Flag">
      <div>${lang.name}</div>
    `;
    div.onclick = () => {
      waitForTranslateSelect(select => {
        select.value = lang.code;
        select.dispatchEvent(new Event('change'));
      });
      selectedFlag.src = `https://flagcdn.com/w40/${lang.flag}.png`;
      modal.classList.remove('active');
    };
    return div;
  }

  languages.forEach(lang => {
    languageGrid.appendChild(createLanguageItem(lang));
  });
</script>

</body>
</html>
