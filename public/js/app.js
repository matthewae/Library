// This file will contain the JavaScript for initializing the page-flip library.

async function initializeFlipbook(pdfPath, bookId) {
    const flipbookContainer = document.getElementById('flipbook');
    flipbookContainer.innerHTML = ''; // Clear previous pages

    // Set worker source for pdf.js
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.worker.min.js';

    try {
        const loadingTask = pdfjsLib.getDocument(pdfPath);
        const pdf = await loadingTask.promise;

        const numPages = pdf.numPages;
        const pagesHtml = [];

        for (let i = 1; i <= numPages; i++) {
            const page = await pdf.getPage(i);
            const viewport = page.getViewport({ scale: 1.5 }); // Adjust scale as needed

            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            await page.render({ canvasContext: context, viewport: viewport }).promise;

            pagesHtml.push(`<div class="page"><img src="${canvas.toDataURL()}" style="width:100%; height:100%; object-fit:contain;" /></div>`);
        }

        flipbookContainer.innerHTML = pagesHtml.join('');

        window.myFlipBook = new St.PageFlip(
            flipbookContainer,
            {
                width: 800, // Set the width of the flipbook
                height: 600, // Set the height of the flipbook
                size: 'stretch', // 'stretch' to fill the container
                minWidth: 315,
                maxWidth: 1000,
                minHeight: 400,
                maxHeight: 1200,
                maxShadowOpacity: 0.5,
                showCover: true,
                mobileScrollSupport: false // disable content scrolling on mobile
            }
        );

        window.myFlipBook.loadFromHtml(pagesHtml);

    } catch (error) {
        console.error('Error loading PDF:', error);
        alert('Failed to load PDF. Please try again later.');
        document.getElementById('bookDetailContainer').style.display = 'flex';
        document.getElementById('flipbookContainer').style.display = 'none';
    }
}