# GameOfPlay
## Índice
- [1. Introducción](#introduccion) 
- [2. Objetivo](#objetivo) 
- [3. Tecnologías](#tecnologías)
  - [3.1. Motor de base de datos](#base_datos)
  - [3.2. Lenguajes y freamworks](#lenguajes)
- [4. Diseño de la aplicación](#diseño)
  - [4.1. Diseño de compra](#dc)
  - [4.2. Diseño de amistad y chat](#dac)
 - [5 Usuarios](#usu)
   - [5.1 Usuarios Anónimos](#usua)
   - [5.2 Usuarios Registrados](#usureg)
   - [5.3 Administrador](#admin)        
<a name="introduccion"></a>						     		
## 1. Introducción 	
Este proyecto consiste en el desarrollo de una aplicación web destinada a la comunidad gamer, el cual consistira en una tienda virtual donde los usuarios puedan comprar sus juegos de manera legal. La aplicación constara de varias interfaces principales, cuyo aspecto y funcionalidad dependerán del rol del usuario. 

- `Usuarios anónimos`: Aquellas personas que podran acceder a la tienda, conocer los servicios ofrecidos por la tienda, así como otros datos referentes a la misma.
- `Usuarios registrados`: Aquellas personas que podran comprar en la tienda e interactuar con la comunidad mediante un chat de amigos
- `Administrador`: El rol de administrador sera el de aquella persona que se encargara de actualizar las noticias de la aplicación, asi como gestionar los planes de pago de los usuarios, en otras palabras sería el soporte técnico

<a name="objetivo"></a>						     		
## 2. Objetivo 
El objetivo principal de este proyecto es ofrecer a los gamers una plataforma segura en donde poder jugar con otra gente, sin que tengan que pagar precios abusivos como en otras plataformas, haciendo una sana competencia a otras tiendas como steam o epic games.

<a name="tecnologías"></a>			
## 3. Tecnologías 
<a name="base_datos"></a>
### 3.1. Motor de base de datos
Como motor para la base de datos empleare `MariaDB`. Las razones son estas:
- Es el motor que más he usado este año.
- Su adquisición es gratuita
- Es multiplataforma
- Es escalable
<a name="lenguajes"></a>
### 3.2. Lenguajes y freamworks
Principalmente la aplicación se desarrollara en su mayor parte en el lenguaje de servidor `PHP`, por lo que empleare el framework de código abierto `Laravel`. Por otro lado la aplicación contara con partes realizadas en `JavaScript`, usando en este caso como framework `Vue.js`.
<a name="diseño"></a>
## 4. Diseño de la aplicación
<a name="dc"></a>
### 4.1 Diseño de compra
![Untitled Document (1)](https://user-images.githubusercontent.com/56919754/113032770-80f83380-9190-11eb-9e4a-6b12e8544e54.png)

<a name="dac"></a>
### 4.2 Diseño de amistad y chat
![Untitled Document (2)](https://user-images.githubusercontent.com/56919754/113034088-003a3700-9192-11eb-8917-0b89be3787e8.png)

<a name="usu"></a>
## 5 Usuarios
<a name="usua"></a>
### 5.1 Usuarios Anónimos
Como se ha detallado antes, el `usuario anónimo` sera todo aquella persona que no este logeada, y por tanto no estara registrada en la base de datos de usuarios.
Dicho esto, los `usuarios anónimos` podran navegar por la tienda, ver los juegos que hay publicados, ver las noticias y ofertas de la tienda, pero al no estar logeados no podrán realizar ninguna compra, ni podran usar cualquier otro servicio de esta como puede ser el soporte tecnico o el chat imcorporado para los `usuarios registrados` de la misma.




