const mainContent = document.querySelector('.main-content');

if (mainContent && !mainContent.querySelector('.top-header')) {
    const header = document.createElement('header');
    header.className = 'top-header tcmg-shared-header';
    header.dir = 'ltr';
    header.innerHTML = `
        <div class="user-profile">
            <div class="avatar" aria-hidden="true">A</div>
            <span class="user-name">Admin</span>
            <button type="button" class="header-icon" aria-label="الرسائل"><i class="fa-regular fa-comment-dots"></i></button>
            <button type="button" class="header-icon notification-icon" aria-label="الإشعارات"><i class="fa-regular fa-bell"></i><span>5</span></button>
            <button type="button" class="header-icon language-icon" aria-label="اللغة العربية">🇪🇬 <i class="fa-solid fa-chevron-down"></i></button>
        </div>
        <label class="search-box"><input type="search" placeholder="ابحث في النظام" aria-label="ابحث في النظام"><i class="fa-solid fa-magnifying-glass"></i></label>
    `;
    mainContent.prepend(header);
}

const globalSearch = document.querySelector('.tcmg-shared-header .search-box input');

if (globalSearch) {
    globalSearch.addEventListener('input', () => {
        const searchTerm = globalSearch.value.trim().toLocaleLowerCase('ar');

        document.querySelectorAll('tbody tr').forEach((row) => {
            row.hidden = !row.textContent.toLocaleLowerCase('ar').includes(searchTerm);
        });
    });
}
