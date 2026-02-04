const fs = require('fs');
const path = require('path');
const sharp = require('sharp');

const IMAGES_DIR = path.resolve(__dirname, '..', 'frontend', 'img');
const QUALITY = 85;
const SUPPORTED_EXTS = new Set(['.png', '.jpg', '.jpeg']);

const SKIP_PATTERNS = [
  /Homepage KOKETSU GRIFE Completa\.png/i,
  /Página Produto Polo KOKETSU\.png/i
];

const isSkippable = (fileName) => SKIP_PATTERNS.some((re) => re.test(fileName));

const walkDir = (dirPath) => {
  const results = [];
  const entries = fs.readdirSync(dirPath, { withFileTypes: true });

  for (const entry of entries) {
    const fullPath = path.join(dirPath, entry.name);
    if (entry.isDirectory()) {
      results.push(...walkDir(fullPath));
    } else {
      results.push(fullPath);
    }
  }

  return results;
};

const formatMB = (bytes) => `${(bytes / 1024 / 1024).toFixed(2)} MB`;

const convertToWebp = async (filePath) => {
  const ext = path.extname(filePath).toLowerCase();
  if (!SUPPORTED_EXTS.has(ext)) return { status: 'skipped' };

  const fileName = path.basename(filePath);
  if (isSkippable(fileName)) return { status: 'skipped', reason: 'not_used' };

  const webpPath = filePath.replace(/\.(png|jpe?g)$/i, '.webp');
  if (fs.existsSync(webpPath)) return { status: 'skipped', reason: 'exists' };

  await sharp(filePath)
    .webp({ quality: QUALITY })
    .toFile(webpPath);

  const originalSize = fs.statSync(filePath).size;
  const webpSize = fs.statSync(webpPath).size;
  const savings = Math.max(0, Math.round((1 - webpSize / originalSize) * 100));

  return {
    status: 'converted',
    originalSize,
    webpSize,
    savings
  };
};

const run = async () => {
  if (!fs.existsSync(IMAGES_DIR)) {
    console.error(`Diretório não encontrado: ${IMAGES_DIR}`);
    process.exit(1);
  }

  console.log('═══════════════════════════════════════════════════════════════');
  console.log('CONVERSÃO WEBP (NODE + SHARP)');
  console.log('═══════════════════════════════════════════════════════════════\n');

  const files = walkDir(IMAGES_DIR);
  let converted = 0;
  let skipped = 0;
  let failed = 0;

  for (const filePath of files) {
    try {
      const result = await convertToWebp(filePath);
      if (result.status === 'converted') {
        converted += 1;
        const fileName = path.basename(filePath);
        console.log(`✅ ${fileName} → ${path.basename(filePath).replace(/\.(png|jpe?g)$/i, '.webp')}`);
        console.log(`   ${formatMB(result.originalSize)} → ${formatMB(result.webpSize)} (${result.savings}% menor)`);
      } else {
        skipped += 1;
      }
    } catch (error) {
      failed += 1;
      console.log(`❌ Erro ao converter ${path.basename(filePath)}: ${error.message}`);
    }
  }

  console.log('\n═══════════════════════════════════════════════════════════════');
  console.log(`RESUMO: ${converted} convertidas, ${skipped} puladas, ${failed} erros`);
  console.log('═══════════════════════════════════════════════════════════════');
};

run();
