function Product(category, name, image, price) {
    this.name = name;
    this.image = image;
    this.price = price;
    this.category = category;
    this.count = ko.observable(1);
  }
  
  function ProductViewModel() {
    var self = this;
    var itemsPerPage = 4;
    self.currentPage = ko.observable(1);
    self.plpname = ko.observable();
    self.plpimage = ko.observable();
    self.plpprice = ko.observable();


    self.categories=ko.observableArray(['shirts','grocery'])
  self.selectedCategory=ko.observable('shirts');
  self.products = ko.observableArray([
    new Product("shirts",'Shirt 1','p1.jpeg',99),
    new Product("shirts",'Shirt 2', 'p2.jpeg', 59),
    new Product("shirts",'Shirt 3', 'p3.jpeg', 39),
    new Product("shirts",'Shirt 4', 'p4.jpeg', 88),
    new Product("shirts",'Shirt 5', 'p5.jpeg', 60),
    new Product("shirts",'Shirt 6', 'p6.jpeg', 150),
    new Product("shirts",'Shirt 7', 'p7.jpeg', 120),
    new Product("shirts",'Shirt 8', 'p8.jpeg', 101),
    new Product("shirts",'Shirt 9', 'p9.jpeg', 36.99),
    new Product("shirts",'Shirt 10', 'p10.jpeg', 160),
    new Product("shirts",'Shirt 11', 'p11.jpeg', 111),
    new Product("shirts",'Shirt 12', 'p12.jpeg', 58),
    new Product("shirts",'Shirt 13', 'p13.jpeg', 129),
    new Product("shirts",'Shirt 14', 'p14.jpeg', 196),

    new Product("grocery",'Basmathi Rice Bag', 'g1.jpg', 100),
    new Product("grocery",'Tur Dal', 'g2.jpg', 3),
    new Product("grocery",'Aashirvaad', 'g3.jpeg', 5),
    new Product("grocery",'Tamatos', 'g4.jpeg', 2),
    new Product("grocery",'Onions', 'g5.jpeg', 2),
    new Product("grocery",'Freedom Oil', 'g6.jpeg', 7 ),
    new Product("grocery",'Ground Nuts', 'g7.jpeg', 3),
    new Product("grocery",'Salt', 'g8.jpeg', 1),
  ]);


  self.displayedProducts = ko.observableArray([]);

  self.cartItems = ko.observableArray([]);

  self.showCartOverlay = ko.observable(false);

  self.toggleCart = function () {
    self.showCartOverlay(!self.showCartOverlay());
    window.scrollTo(0, 4000);
  };

  self.clickme = function (){
    console.log('hello')
    window.scrollTo(0,document.body.scrollHeight);
  }

  self.scrollToBottom = function () {
    window.scrollTo(0, document.body.scrollHeight);
  };

  self.scrollToTopOnRefresh = function () {
    window.scrollTo(0, 0);
  }

  
  self.addToCart = function (product) {
    var counter=ko.observable(0);
    var existingProduct = self.cartItems().find(function (item) {
      return item.name === product.name;
    });

    if (existingProduct) {
      existingProduct.count(existingProduct.count() + 1);
      counter(counter()+1)
      existingProduct.count.valueHasMutated();
    } else {
      product.count = ko.observable(1);
      self.cartItems.push(product);
    }
  };

  self.removeFromCart = function (product) {
    self.cartItems.remove(product);
  };

  self.calculateTotalAmount = ko.computed(function () {
    var total = 0;
    for (var i = 0; i < self.cartItems().length; i++) {
      var item = self.cartItems()[i];
      total += item.price * item.count();
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

  self.selectedCategory.subscribe(self.scrollToBottom);
  self.currentPage.subscribe(self.scrollToTopOnRefresh);





  
    // ... Your existing code ...
  
    // Observable to track whether to show the product card or not
    self.showProductCard = ko.observable(true);
  
    // Observable to store the selected product to be shown in the card
    self.selectedProduct = ko.observable();
  
    // Function to show the product card when a product is clicked
    self.showProductDetails = function (product) {
    console.log('hello')
      self.selectedProduct(product);
      self.showProductCard(true);
      document.body.style.overflow = 'hidden'; // Disable scrolling on the background
    };
  
    // Function to hide the product card when clicked outside of it
    self.closeProductCard = function () {
      self.showProductCard(false);
      document.body.style.overflow = 'auto'; // Enable scrolling on the background
    };
  
    // ... Your existing code ...
  }
  
  // Apply the ViewModel bindings
  ko.applyBindings(new ProductViewModel());
  