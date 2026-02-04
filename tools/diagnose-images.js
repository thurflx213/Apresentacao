const fs = require('fs');
const path = require('path');

const ROOT = path.resolve(__dirname, '..');
const PAGES_DIR = path.join(ROOT, 'frontend', 'pages');
const JS_DIR = path.join(ROOT, 'frontend', 'js');

const readFile = (filePath) => fs.readFileSync(filePath, 'utf8');

const listFiles = (dir, ext) => {
  if (!fs.existsSync(dir)) return [];
  return fs.readdirSync(dir)
    .filter((name) => name.toLowerCase().endsWith(ext))
    .map((name) => path.join(dir, name));
};

const findImgsWithoutPicture = (html, fileName) => {
  const results = [];
  const regex = /<img\b[^>]*>/gi;
  let match;
  while ((match = regex.exec(html)) !== null) {
    const imgTag = match[0];
    const startIndex = match.index;

    // Determine if this <img> is inside a <picture> block
    const before = html.slice(0, startIndex);
    const lastPictureOpen = before.lastIndexOf('<picture');
    const lastPictureClose = before.lastIndexOf('</picture>');
    const isInsidePicture = lastPictureOpen > lastPictureClose;

    if (!isInsidePicture) {
      results.push({ fileName, imgTag });
    }
  }
  return results;
};

const findImgTagsInJs = (js, fileName) => {
  const results = [];
  const regex = /<img\b[^>]*>/gi;
  let match;
  while ((match = regex.exec(js)) !== null) {
    const imgTag = match[0];
    const startIndex = match.index;
    const before = js.slice(0, startIndex);
    const lastPictureOpen = before.lastIndexOf('<picture');
    const lastPictureClose = before.lastIndexOf('</picture>');
    const isInsidePicture = lastPictureOpen > lastPictureClose;

    if (!isInsidePicture) {
      results.push({ fileName, imgTag });
    }
  }
  return results;
};

const run = () => {
  console.log('═══════════════════════════════════════════════════════════════');
  console.log('DIAGNÓSTICO DE IMAGENS (Picture Tag / WebP)');
  console.log('═══════════════════════════════════════════════════════════════\n');

  const htmlFiles = listFiles(PAGES_DIR, '.html');
  const jsFiles = listFiles(JS_DIR, '.js');

  let htmlFindings = [];
  let jsFindings = [];

  for (const filePath of htmlFiles) {
    const content = readFile(filePath);
    const fileName = path.relative(ROOT, filePath);
    htmlFindings = htmlFindings.concat(findImgsWithoutPicture(content, fileName));
  }

  for (const filePath of jsFiles) {
    const content = readFile(filePath);
    const fileName = path.relative(ROOT, filePath);
    jsFindings = jsFindings.concat(findImgTagsInJs(content, fileName));
  }

  if (htmlFindings.length === 0 && jsFindings.length === 0) {
    console.log('✅ Nenhuma <img> fora de <picture> encontrada.');
    return;
  }

  if (htmlFindings.length > 0) {
    console.log('⚠️  HTML com <img> fora de <picture>:' );
    htmlFindings.forEach((item) => {
      console.log(`- ${item.fileName}: ${item.imgTag}`);
    });
    console.log('');
  }

  if (jsFindings.length > 0) {
    console.log('⚠️  JS com <img> fora de <picture>:' );
    jsFindings.forEach((item) => {
      console.log(`- ${item.fileName}: ${item.imgTag}`);
    });
  }
};

run();
