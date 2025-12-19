$root = Get-Location
$imgDir = Join-Path $root 'img'
Write-Output "Imagem dir: $imgDir"
Get-ChildItem -Path $imgDir -File -Recurse | ForEach-Object {
    $oldName = $_.Name
    $normalized = [System.Text.RegularExpressions.Regex]::Replace($_.Name.Normalize([System.Text.NormalizationForm]::FormD), '\p{Mn}', '')
    $safe = $normalized -replace '[^A-Za-z0-9\._-]', '-'
    $safe = $safe -replace '-{2,}', '-'
    $safe = $safe.Trim('-')
    $safe = $safe.ToLower()
    if ($oldName -ne $safe) {
        Write-Output "Renomeando: $oldName -> $safe"
        Rename-Item -LiteralPath $_.FullName -NewName $safe
        $escapedOld = [Regex]::Escape($oldName)
        Get-ChildItem -Path $root -Include *.html,*.php,*.js,*.css -Recurse -File | ForEach-Object {
            $path = $_.FullName
            $content = Get-Content -Raw -LiteralPath $path
            if ($content -match $escapedOld) {
                $newContent = $content -replace $escapedOld, $safe
                Set-Content -LiteralPath $path -Value $newContent
                Write-Output "  Atualizado em: $path"
            }
        }
    }
}
Write-Output "Concluído."