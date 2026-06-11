$sourceDir = "c:\xampp\htdocs\filkomcare"
$tempDir = "c:\xampp\htdocs\filkomcare_temp"
$zipPath = "c:\xampp\htdocs\filkomcare_update.zip"

# Clean up previous temp dir and zip if they exist
if (Test-Path $tempDir) { Remove-Item -Path $tempDir -Recurse -Force }
if (Test-Path $zipPath) { Remove-Item -Path $zipPath -Force }

Write-Host "Creating temp directory..."
New-Item -ItemType Directory -Path $tempDir | Out-Null

Write-Host "Copying files (this might take a minute)..."
# Get all items except node_modules, .git, tests
Get-ChildItem -Path $sourceDir | Where-Object { 
    $_.Name -notin @('.git', 'node_modules', 'tests', 'filkomcare_update.zip', 'zip_project.ps1') 
} | Copy-Item -Destination $tempDir -Recurse -Force

Write-Host "Compressing to zip file..."
Compress-Archive -Path "$tempDir\*" -DestinationPath $zipPath -Force

Write-Host "Cleaning up temp directory..."
Remove-Item -Path $tempDir -Recurse -Force

Write-Host "Done! Zip file created at: $zipPath"
