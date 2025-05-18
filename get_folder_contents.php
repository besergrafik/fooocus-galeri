<?php
header('Content-Type: application/json');

// Hangi klasörü tarayacağımızı belirle
$folder = isset($_GET['folder']) ? $_GET['folder'] : 'resimler/';
$folder = realpath(__DIR__ . '/' . $folder); // Tam yol

// Güvenlik kontrolü - dizin dışına çıkılmasını engelle
if (strpos($folder, realpath(__DIR__)) !== 0) {
  echo json_encode(['error' => 'Geçersiz klasör yolu']);
  exit;
}

$files = [];

// Klasör var mı kontrol et
if (is_dir($folder)) {
  // Klasör içeriğini oku
  foreach (new DirectoryIterator($folder) as $fileInfo) {
    if ($fileInfo->isDot() || !$fileInfo->isFile()) continue;
    
    // Sadece resim dosyalarını filtrele
    $extension = strtolower($fileInfo->getExtension());
    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
      $files[] = $fileInfo->getFilename();
    }
  }
}

// Sonuçları JSON olarak döndür
echo json_encode(['files' => $files]);
?>