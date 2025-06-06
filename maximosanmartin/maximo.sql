CREATE TABLE fotos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255),
  ruta VARCHAR(255),
  estilo ENUM('formal', 'casual', 'urbano'),
  fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);