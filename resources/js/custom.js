document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.collapse-column').forEach(element => {
        element.addEventListener('click', (event) => {
            const content = event.currentTarget.nextElementSibling;
            content.classList.toggle('hidden');
        });
    });
});
