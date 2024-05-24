# BookStore Application 

This is a PHP and SQL-based bookstore application using Docker and Git version control.

## Getting Started 
1. Clone the repository: **'git clone https://github.com/csangar22/bookstore.git'**.
2. Build and start the containers: **'docker-compose up-d'**.
3. Acces the aplication: **'https://localhost:9000'**

### Frame Home ###
![image](https://github.com/csangar22/BookStore/assets/124258183/1917e3d7-b1ad-451d-8c5e-553be00b99a5)

### Frame Books ##
![image](https://github.com/csangar22/BookStore/assets/124258183/f3a742d7-fd71-4a07-8309-6babeb7f6602)

### Frame Register/Log In ### 
![image](https://github.com/csangar22/BookStore/assets/124258183/46c20705-5082-49da-85e7-17a1986ed433)


# Aplicación BookStore

Esta es una aplicación de libreria basada en PHP y SQL utilizando Docker y control de versiones Git.

## Para empezar
1. Clona el repositorio: **'git clone https://github.com/csangar22/bookstore.git'**.
2. Construye e inicia los contenedores docker: **'docker-compose up-d'**.
3. Accede a la aplicación: **'https://localhost:9000'**






















El tipo de base de datos que utilices puede influir en algunos aspectos del despliegue de tu aplicación, pero en general, puedes desplegar una aplicación que utilice MySQL y phpMyAdmin sin problemas. Aquí te detallo algunas consideraciones y pasos a seguir para desplegar tu aplicación web que utiliza PHP y MySQL:

### Consideraciones para Desplegar la Aplicación

1. **Compatibilidad del Hosting**:
   - Asegúrate de que tu servicio de hosting soporte PHP y MySQL. La mayoría de los proveedores de hosting web, como Bluehost, SiteGround, y HostGator, entre otros, ofrecen soporte para estas tecnologías.
   - Verifica que el servidor de hosting tenga phpMyAdmin disponible, ya que es una herramienta común para administrar bases de datos MySQL.

2. **Acceso a la Base de Datos**:
   - Configura tu base de datos en el servidor de producción y asegúrate de que las credenciales de la base de datos estén correctamente configuradas en tu aplicación.
   - Si migras una base de datos local a un servidor, asegúrate de exportar los datos desde tu entorno de desarrollo (usando phpMyAdmin, por ejemplo) y luego importarlos al servidor de producción.

3. **Configuración del Archivo `config.php`**:
   - Asegúrate de tener un archivo de configuración para tu base de datos que se adapte al entorno de producción. Puedes utilizar variables de entorno para almacenar las credenciales de la base de datos de forma segura.

### Pasos para Desplegar la Aplicación

1. **Exportar la Base de Datos**:
   - En tu entorno de desarrollo, utiliza phpMyAdmin para exportar la base de datos a un archivo SQL.
   - Ve a phpMyAdmin, selecciona la base de datos, y haz clic en la pestaña "Exportar". Sigue las instrucciones para guardar el archivo SQL en tu computadora.

2. **Subir la Base de Datos al Servidor**:
   - Accede a phpMyAdmin en tu servidor de producción.
   - Crea una nueva base de datos.
   - Importa el archivo SQL que exportaste anteriormente a la nueva base de datos. Ve a la pestaña "Importar" en phpMyAdmin y sube el archivo SQL.

3. **Subir Archivos de la Aplicación**:
   - Utiliza un cliente FTP (como FileZilla) para subir los archivos de tu aplicación al servidor.
   - Asegúrate de subir todos los archivos, incluyendo los scripts PHP, archivos HTML, CSS, JavaScript y cualquier otro recurso necesario.

4. **Configurar el Archivo de Conexión a la Base de Datos**:
   - En tu servidor de producción, edita el archivo de configuración de la base de datos (`config.php` o similar) para que apunte a la base de datos en el servidor de producción.
   - Asegúrate de actualizar los detalles como el nombre de la base de datos, el nombre de usuario, la contraseña y el host.

   ```php
   <?php
   // config.php
   $servername = "your_server_name";
   $username = "your_database_username";
   $password = "your_database_password";
   $dbname = "your_database_name";

   // Crear conexión
   $conn = new mysqli($servername, $username, $password, $dbname);

   // Verificar conexión
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   ```

5. **Probar la Aplicación**:
   - Asegúrate de que todos los enlaces, formularios y consultas a la base de datos funcionen correctamente en el entorno de producción.
   - Realiza pruebas exhaustivas para garantizar que no haya problemas con la conexión a la base de datos ni con la funcionalidad de la aplicación.

### Herramientas Adicionales

- **phpMyAdmin**: Es una herramienta muy útil para la gestión de bases de datos MySQL. Viene incluida en muchos paneles de control de hosting (como cPanel).
- **Clientes FTP**: FileZilla es una opción popular para transferir archivos desde tu computadora local al servidor de producción.
- **Panel de Control del Hosting**: La mayoría de los servicios de hosting ofrecen paneles de control como cPanel o Plesk que facilitan la gestión de tu sitio web y bases de datos.

### Desplegando en Plataformas de Cloud Hosting

Si optas por servicios de cloud hosting como AWS, Google Cloud, o Heroku, el proceso puede ser ligeramente diferente y más avanzado, pero las mismas consideraciones básicas se aplican:

- Configuración del servidor.
- Configuración de la base de datos.
- Despliegue del código.
- Pruebas y ajustes finales.

En resumen, sí puedes desplegar tu aplicación que utiliza MySQL y phpMyAdmin en la mayoría de los servicios de hosting que soportan estas tecnologías. Solo necesitas asegurarte de que todos los componentes estén correctamente configurados y que tus datos sean migrados y configurados adecuadamente en el entorno de producción.
