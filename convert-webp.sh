#!/bin/bash
# Script para converter imagens para WebP usando ImageMagick

IMG_DIR="./frontend/img"
QUALITY=85

echo "🔄 Iniciando conversão de imagens para WebP..."

for file in $IMG_DIR/*.{jpg,jpeg,png}; do
    if [ -f "$file" ]; then
        filename=$(basename "$file")
        name="${filename%.*}"
        ext="${filename##*.}"
        webp_file="$IMG_DIR/${name}.webp"
        
        # Skip if already exists
        if [ -f "$webp_file" ]; then
            echo "⏭️  Pulando: $filename (WebP já existe)"
            continue
        fi
        
        # Convert using ImageMagick
        if convert "$file" -quality $QUALITY "$webp_file" 2>/dev/null; then
            old_size=$(stat -c%s "$file" 2>/dev/null || stat -f%z "$file" 2>/dev/null)
            new_size=$(stat -c%s "$webp_file" 2>/dev/null || stat -f%z "$webp_file" 2>/dev/null)
            savings=$((100 - (new_size * 100 / old_size)))
            echo "✅ Convertido: $filename → ${name}.webp (-${savings}%)"
        else
            echo "❌ Erro ao converter: $filename"
        fi
    fi
done

echo "✨ Conversão concluída!"
