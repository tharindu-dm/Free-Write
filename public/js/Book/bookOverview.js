document.addEventListener('DOMContentLoaded', function() {
    const chapters = [
        "Chapter 1: The Beginning",
        "Chapter 2: Taking Flight",
        "Chapter 3: Mountain Peaks",
        "Chapter 4: The Journey Continues"
    ];

    const chaptersList = document.getElementById('chapters-list');

    chapters.forEach((chapter, index) => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = 'book/#'; // You can set actual chapter links here
        a.textContent = chapter;
        li.appendChild(a);
        chaptersList.appendChild(li);
    });
});