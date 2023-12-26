import Epub from 'epubjs';

let book_url = document.getElementById('book-url').value;
console.log(window.location.origin+book_url);
let book = Epub(window.location.origin+book_url);
let rendition = book.renderTo("area", { 
    flow: "paginated", 
    width: "900",
    height: "600",
    allowScriptedContent: true
});

let displayed = rendition.display();

book.ready.then(() => {

    let next = document.getElementById("next");

    next.addEventListener("click", function(e){
        book.package.metadata.direction === "rtl" ? rendition.prev() : rendition.next();
        e.preventDefault();
    }, false);

    let prev = document.getElementById("prev");
    prev.addEventListener("click", function(e){
        book.package.metadata.direction === "rtl" ? rendition.next() : rendition.prev();
        e.preventDefault();
    }, false);

    let keyListener = function(e){

        // Left Key
        if ((e.keyCode || e.which) == 37) {
        book.package.metadata.direction === "rtl" ? rendition.next() : rendition.prev();
        }

        // Right Key
        if ((e.keyCode || e.which) == 39) {
        book.package.metadata.direction === "rtl" ? rendition.prev() : rendition.next();
        }

    };
    
    rendition.on("keyup", keyListener);
    document.addEventListener("keyup", keyListener, false);
});


















  
