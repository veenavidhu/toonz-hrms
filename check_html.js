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
    const counts = {};
    
    while ((match = tagRegex.exec(content)) !== null) {
        const fullTag = match[0];
        const tagName = match[1].toLowerCase();
        
        if (fullTag.endsWith('/>') || voidElements.has(tagName) || tagName.startsWith('x-')) continue;
        
        if (!counts[tagName]) counts[tagName] = 0;
        
        if (fullTag.startsWith('</')) {
            counts[tagName]--;
        } else {
            counts[tagName]++;
        }
    }

    const errors = [];
    for (const tag in counts) {
        if (counts[tag] !== 0) {
            errors.push(`${tag}: ${counts[tag] > 0 ? '+' : ''}${counts[tag]}`);
        }
    }

    if (errors.length > 0) {
        console.log(`Mismatch in ${file.replace(/\\/g, '/')} -> ${errors.join(', ')}`);
    }
}
