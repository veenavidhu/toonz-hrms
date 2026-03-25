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

const files = getFiles('e:/xampp/htdocs/HRMS/resources/views');

for (const file of files) {
    if (file.includes('auth/')) continue; // Skip auth pages
    
    let content = fs.readFileSync(file, 'utf8');
    let original = content;

    // Replacement for background and borders
    content = content.replace(/bg-gray-50 border border-gray-100/g, 'bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400');
    content = content.replace(/bg-gray-50 border border-gray-300/g, 'bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400');
    content = content.replace(/bg-white border border-gray-200/g, 'bg-gray-50 border-2 border-[#E5E7EB] hover:border-gray-400');
    
    // Replacement for border styling specifically with dark borders handled
    content = content.replace(/dark:border-gray-700/g, ''); // Clear out dark borders for clean reset if they exist

    // Replace focus ring
    content = content.replace(/focus:border-blue-500 focus:ring-2 focus:ring-blue-500\/20/g, 'focus:border-black focus:ring-0');
    content = content.replace(/focus:border-blue-500/g, 'focus:border-black focus:ring-0');

    // Upgrade rounding
    content = content.replace(/rounded-sm/g, 'rounded-xl');
    content = content.replace(/rounded-lg/g, 'rounded-xl');

    // Improve outline/transitions
    content = content.replace(/outline-none focus:bg-white/g, 'outline-none focus:bg-white duration-300');

    if (content !== original) {
        // Clean up any double spaces that might be introduced
        content = content.replace(/\s+/g, ' ');
        fs.writeFileSync(file, content, 'utf8');
        console.log(`Updated styles in ${file}`);
    }
}
