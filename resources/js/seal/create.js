document.getElementById('add-seal-form').addEventListener('submit', function(event) {
    // Показываем спиннер и блокируем кнопку
    document.getElementById('loading-spinner').classList.remove('hidden');
    document.getElementById('add-seal-form-submit-btn-text').classList.add('hidden');
    document.getElementById('add-seal-form-submit-btn').disabled = true;
});
