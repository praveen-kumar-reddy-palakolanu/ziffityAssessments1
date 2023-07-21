function Product(category,name, image, price) {
  this.name = name;
  this.image = image;
  this.price = price;
  this.category=category;
  this.count = ko.observable(1);
}

function ProductViewModel() {
  var self = this;
  var itemsPerPage = 4;
  self.currentPage = ko.observable(1); 

  self.categories=ko.observableArray(['shirts','grocery'])
  self.selectedCategory=ko.observable('shirts');
  self.products = ko.observableArray([
    new Product("shirts",'Shirt 1','images/p1.jpeg',99),
    new Product("shirts",'Shirt 2', 'images/p2.jpeg', 59),
    new Product("shirts",'Shirt 3', 'images/p3.jpeg', 39),
    new Product("shirts",'Shirt 4', 'images/p4.jpeg', 88),
    new Product("shirts",'Shirt 5', 'images/p5.jpeg', 60),
    new Product("shirts",'Shirt 6', 'images/p6.jpeg', 150),
    new Product("shirts",'Shirt 7', 'images/p7.jpeg', 120),
    new Product("shirts",'Shirt 8', 'images/p8.jpeg', 101),
    new Product("shirts",'Shirt 9', 'images/p9.jpeg', 36.99),
    new Product("shirts",'Shirt 10', 'images/p10.jpeg', 160),
    new Product("shirts",'Shirt 11', 'images/p11.jpeg', 111),
    new Product("shirts",'Shirt 12', 'images/p12.jpeg', 58),
    new Product("shirts",'Shirt 13', 'images/p13.jpeg', 129),
    new Product("shirts",'Shirt 14', 'images/p14.jpeg', 196),

    new Product("grocery",'Basmathi Rice Bag', 'images/g1.jpg', 100),
    new Product("grocery",'Tur Dal', 'images/g2.jpg', 3),
    new Product("grocery",'Aashirvaad', 'images/g3.jpeg', 5),
    new Product("grocery",'Tamatos', 'images/g4.jpeg', 2),
    new Product("grocery",'Onions', 'images/g5.jpeg', 2),
    new Product("grocery",'Freedom Oil', 'images/g6.jpeg', 7 ),
    new Product("grocery",'Ground Nuts', 'images/g7.jpeg', 3),
    new Product("grocery",'Salt', 'images/g8.jpeg', 1),
  ]);


  self.displayedProducts = ko.observableArray([]);


  var localCart = JSON.parse(localStorage.getItem('cartItems'))

  
  self.cartItems = ko.observableArray([]);

  if(localCart.length==null)
  {
    localCart=[]
  }
  if(localCart.length>0)
{
  localCart.forEach((ele) => {

    self.cartItems.push(new Product(ele.category,ele.name,ele.image,ele.price))
    
  });
}

  self.showCartOverlay = ko.observable(false);

  

  self.toggleCart = function () {
    self.showCartOverlay(!self.showCartOverlay());
  };

  self.clickme = function (){
    self.productName(product.name);
    self.productImage(product.image);
    self.productPrice("Product Price: $" + product.price);

    window.location.href = 'product-details.html?details=' + encodeURIComponent(JSON.stringify(product));
  }



  self.addToCart = function (product) {
    var existingProduct = self.cartItems().find(function (item) {
      return item.name === product.name;
    });

  
    if (existingProduct) {
      existingProduct.count+=1
    } else {
      product.count = ko.observable(1);
      self.cartItems.push(product);
    }
    var cartItemsJSON = ko.toJSON(self.cartItems());
    localStorage.setItem('cartItems', cartItemsJSON);
  };
  

  self.removeFromCart = function (product) {
    self.cartItems.remove(product);
  };
//  self.fun=function()
//  {
//   window.location.href="product-details.html";
//  }
  self.calculateTotalAmount = ko.computed(function () {
    var total = 0;
    for (var i = 0; i < self.cartItems().length; i++) {
      var product = self.cartItems()[i];
      total += product.count()*product.price
    }
    return total.toFixed(2);
  });

  self.totalAmount = ko.computed(function () {
    var total = self.calculateTotalAmount();
    return '$' + total;
  });

  self.showProductDetails = function (product) {
    var productDetails = ko.toJSON(product);
    var encodedProductDetails = encodeURIComponent(productDetails);
    window.location.href = 'product-details.html?details=' + encodedProductDetails;
  };

  self.paginatedProducts = ko.computed(function () {
    var startIndex = (self.currentPage() - 1) * itemsPerPage;
    var endIndex = startIndex + itemsPerPage;
    return self.displayedProducts.slice(startIndex, endIndex);
  });

  self.totalPages = ko.computed(function () {
    return Math.ceil(self.displayedProducts().length / itemsPerPage);
  });

  self.previousPage = function () {
    if (self.currentPage() > 1) {
      self.currentPage(self.currentPage() - 1);
    }
  };

  self.nextPage = function () {
    if (self.currentPage() < self.totalPages()) {
      self.currentPage(self.currentPage() + 1);
    }
  };

  self.goToPage = function (page) {
    self.currentPage(page);
  };

  self.updateCartCount = function () {
    return self.cartItems().length;
  };

  self.cartItems.subscribe(function () {
    self.updateCartCount();
  });

  self.showProductsByCategory = function () {
    var category = self.selectedCategory();
    if (category === '') {
      self.displayedProducts(self.products());
    } else {
      var filteredProducts = self.products().filter(function (product) {
        return product.category === category;
      });
      self.displayedProducts(filteredProducts);
    }
    self.currentPage(1);
  };

  self.showProductsByCategory();

  // self.selectedCategory.subscribe(self.scrollToBottom);
  // self.currentPage.subscribe(self.scrollToTopOnRefresh);

}

ko.applyBindings(new ProductViewModel());

