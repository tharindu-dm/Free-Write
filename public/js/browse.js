button.addEventListener('click', function() {
    const bookId = this.getAttribute('data-id');
    window.location.href = '/bookDetails.php?id=' + bookId;
});
