const fs = require('fs');
const path = require('path');

function getFiles(dir, filesList = []) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const filePath = path.join(dir, file);
        if (fs.statSync(filePath).isDirectory()) {
            getFiles(filePath, filesList);
        } else if (filePath.endsWith('.blade.php')) {
            filesList.push(filePath);
        }
    }
    return filesList;
}

const voidElements = new Set(['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr', '!doctype']);
const files = getFiles('e:/xampp/htdocs/HRMS/resources/views');

for (const file of files) {
    const content = fs.readFileSync(file, 'utf8');
    const tagRegex = /<\/?([a-zA-Z0-9\-]+)[^>]*>/g;
    let match;
    const stack = [];
    let hasError = false;
    
    // Naively strip PHP/Blade things that might have HTML inside them logic? No, let's just parse.
    
    while ((match = tagRegex.exec(content)) !== null) {
        const fullTag = match[0];
        const tagName = match[1].toLowerCase();
        
        if (fullTag.endsWith('/>') || voidElements.has(tagName) || tagName.startsWith('x-')) continue;
        
        if (fullTag.startsWith('</')) {
            if (stack.length > 0 && stack[stack.length - 1] === tagName) {
                stack.pop();
            } else {
                // If the top doesn't match, maybe it's unnested?
                // Let's print the mismatch
                // Check if the tag even exists in stack.
                const idx = stack.lastIndexOf(tagName);
                if (idx !== -1) {
                    // It was opened, but something else was opened inside it and not closed.
                    const unclosed = stack.slice(idx + 1).reverse();
                    console.log(`Mismatch in ${file.replace(/\\/g, '/')}: Expected </${unclosed[0]}> or similar, but found </${tagName}>. Stack top: ${stack[stack.length - 1]}`);
                    hasError = true;
                    // Try to recover by popping up to that tag
                    stack.splice(idx, stack.length - idx);
                } else {
                    console.log(`Mismatch in ${file.replace(/\\/g, '/')}: Found closing </${tagName}> without matching open tag.`);
                    hasError = true;
                }
            }
        } else {
            stack.push(tagName);
        }
    }

    if (stack.length > 0 && !hasError && stack[0] !== 'length') {
        console.log(`Unclosed elements in ${file.replace(/\\/g, '/')}: ${stack.join(', ')}`);
    }
}
