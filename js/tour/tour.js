// Instance the tour
var tour = new Tour({
backdrop: true,
backdropContainer: 'body',
smartPlacement: false,
  steps: [
  {
    element: "#tx_buscador",
    title: "Buscador",
    content: "Realice la busqueda del producto que desea"
  },
  {
    element: "#publicidadessuperiores",
    title: "Publicidad 1",
    content: "Coloque la publicidad que usted desee ya sea suya o agente externo"
  },
  {
    element: "#iniciodesesion",
    title: "Inicio de sesion",
    content: "Acceso y registro para usuarios"
  },
  {
    element: "#tx_carrito",
    title: "Carrito de compras",
    content: "Visualice los productos seleccionados para su compra"
  },
  {
    element: "#productos",
    title: "Menu de productos",
    content: "Mostrará todas las clasificaciones que tienen los productos en la tienda"
  },
  {
    element: "#redessociales",
    title: "Links Sociales",
    content: "Acceso a las redes sociales de la compañia o negocio que vende en la tienda"
  },
  {
    element: "#contactoyterminos",
    title: "Contacto y terminos",
    content: "Boton de contacto y Terminos de la tienda"
  },
  
  {
    element: "#breadcrumbs",
    title: "Mini guía",
    content: "Guía de las clasificaciones por las que navega"
  },
  {
    element: "#bannersuperiores",
    title: "Banner Grandes",
    content: "Coloque la imagen que usted desee mostrar a sus clientes"
  },
  {
    element: "#ivaono",
    title: "Aplica o no",
    content: "Indique a sus cliente si los productos incluyen o no IVA"
  },
  {
    element: "#masvendidos",
    title: "Mas vendidos",
    content: "Productos mas vendidos que se colocaran automaticamente"
  },
  {
    element: "#contactosinferiores",
    title: "Minicontacto",
    content: "Mostrara el teléfono y correo a sus clientes"
  },
  {
    element: "#categoriasdestacadas",
    title: "Categorias Destacadas",
    content: "Podra destacar las categorias de sus productos que desee a los usuarios"
  },
  {
    element: "#productosdestacados",
    title: "Destacados",
    content: "Desde su panel administrativo podrá colocar los productos destacados que desee"
  },
  {
    element: "#productosenoferta",
    title: "Ofertas",
    content: "Mostrara los productos que se encuentren en oferta en su tienda"
  },
  {
    element: "#publicidadinferior",
    title: "Banner Inferior",
    content: "Tiene otro espacio disponible para publicidad suya o externa"
  },
  {
    element: "#nombre_pro",
    title: "Identificacion",
    content: "Nombre de los productos"
  },
  {
    element: "#verdetalles",
    title: "Detalles",
    content: "Link que llevara al usuario a ver los detalles del producto"
  },
  {
    element: "#agregarcar",
    title: "Agregar",
    content: "Agregue el producto al carrito de compras"
  },
  {
    element: "#etiquetadesta",
    title: "Etiqueta destacado",
    content: "Designara los productos destacados"
  },
  {
    element: "#etiquetaoferta",
    title: "Etiqueta Oferta",
    content: "Designara los productos en oferta"
  }
  
]});

// Initialize the tour
tour.init();

// Start the tour
tour.start();