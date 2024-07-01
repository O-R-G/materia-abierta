function shuffle(array) {
    array.sort(() => Math.random() - 0.5);
}

function wrap_span(container){
    let parent = container.cloneNode(true);
    let output = document.createElement('div');
    for(let child of parent.childNodes) {
        if(child.nodeType === 3) {
            for(let char of child.textContent) {
                let s = document.createElement('span');
                s.className = 'gradient-pixel';
                s.textContent = char;
                output.appendChild(s);
            }
        } else if(child.nodeType === 1){
            if(child.tagName.toLowerCase() === 'br') {
                output.appendChild(child.cloneNode());
                continue;
            }
            let result = wrap_span(child);
            let clone = child.cloneNode();
            clone.innerHTML = result.innerHTML;
            output.appendChild(clone);
            // parent.firstChild.innerHTML = temp.innerHTML = temp.innerHTML;
        }
    }
    return output;
}