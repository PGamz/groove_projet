const deleteItem = document.querySelectorAll('.delete');

for (let i = 0; i < deleteItem.length; i++) {
    deleteItem[i].addEventListener('click', function(event) {
        event.preventDefault();

        const choice = confirm(this.getAttribute('data-confirm'));

        if (choice) {
            window.location.href = this.getAttribute('href');
        }
    });
}