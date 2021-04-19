var format = document.getElementsByClassName('format');

for ( let tag of format) {
    tag.innerHTML = new Intl.NumberFormat().format(tag.innerHTML);    
}



