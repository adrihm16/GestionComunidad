---
trigger: always_on
---

//This is a puml file that contains the database scheme.
@startuml

!theme plain
hide circle
skinparam linetype ortho

' ENTIDADES

entity "Usuario" as user {
  *id : INT <<PK>>
  --
  nombre : VARCHAR(100)
  apellidos : VARCHAR(100)
  email : VARCHAR(150) <<Unique>>
  password_hash : VARCHAR(255)
  telefono : VARCHAR(20)
  rol_sistema : ENUM('admin', 'vecino')
  cargo_comunidad : VARCHAR(50) <<Nullable>> -- Ej: 'Presidente'
  avatar_url : VARCHAR(255)
  fecha_registro : DATETIME
}

entity "Inmueble" as property {
  *id : INT <<PK>>
  --
  *propietario_id : INT <<FK>>
  tipo : ENUM('piso', 'local', 'garaje', 'trastero')
  bloque : VARCHAR(10) <<Nullable>>
  piso : VARCHAR(10)
  puerta : VARCHAR(10)
}

entity "Recibo" as receipt {
  *id : INT <<PK>>
  --
  *inmueble_id : INT <<FK>>
  concepto : VARCHAR(100) -- Ej: 'Cuota Marzo 2026'
  monto : DECIMAL(10,2)
  fecha_emision : DATE
  fecha_vencimiento : DATE
  fecha_pago : DATETIME <<Nullable>>
  estado : ENUM('pendiente', 'pagado', 'vencido')
  url_factura_pdf : VARCHAR(255)
}

entity "Incidencia" as issue {
  *id : INT <<PK>>
  --
  *creador_id : INT <<FK>>
  titulo : VARCHAR(100)
  descripcion : TEXT
  estado : ENUM('pendiente', 'en_proceso', 'resuelta', 'rechazada')
  prioridad : ENUM('baja', 'media', 'alta')
  foto_url : VARCHAR(255) <<Nullable>>
  fecha_creacion : DATETIME
  fecha_actualizacion : DATETIME
}

entity "Noticia" as news {
  *id : INT <<PK>>
  --
  *autor_id : INT <<FK>> -- Generalmente el Admin
  titulo : VARCHAR(150)
  contenido : TEXT
  adjunto_url : VARCHAR(255) <<Nullable>> -- Para PDFs/Actas
  fecha_publicacion : DATETIME
}

entity "Evento" as event {
  *id : INT <<PK>>
  --
  *creador_id : INT <<FK>>
  titulo : VARCHAR(100)
  descripcion : TEXT
  fecha_inicio : DATETIME
  fecha_fin : DATETIME
  tipo : ENUM('junta', 'mantenimiento', 'obra', 'otro')
}

' RELACIONES

' Un usuario puede tener varios inmuebles (1 a N)
user ||..|{ property : "es propietario de"

' Un inmueble genera muchos recibos (1 a N)
property ||..|{ receipt : "genera"

' Un usuario reporta muchas incidencias (1 a N)
user ||..|{ issue : "reporta"

' Un usuario (admin) publica muchas noticias (1 a N)
user ||..|{ news : "publica"

' Un usuario (admin) crea muchos eventos (1 a N)
user ||..|{ event : "organiza"

@enduml