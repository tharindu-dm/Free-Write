document.addEventListener('DOMContentLoaded', function() {
    const chapterContent = document.getElementById('chapterContent');
    const progressBar = document.getElementById('progressBar');

    chapterContent.addEventListener('scroll', updateProgressBar);
    
    function updateProgressBar() {
        const scrollPosition = chapterContent.scrollTop;
        const maxScroll = chapterContent.scrollHeight - chapterContent.clientHeight;
        const progress = (scrollPosition / maxScroll) * 100;
        progressBar.style.width = `${progress}%`;
    }

    chapterContent.addEventListener('contextmenu', function(e) {
        if (e.target.closest('.chapter-content')) {
            e.preventDefault();
        }
    });

    document.getElementById('prevChapter').addEventListener('click', function() {
        alert('Navigate to previous chapter');
    });

    document.getElementById('nextChapter').addEventListener('click', function() {
        alert('Navigate to next chapter');
    });

    document.querySelector('.comment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Comment submitted');
        this.reset();
    });
});