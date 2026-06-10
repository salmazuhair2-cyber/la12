// document.getElementById("profile-icon").addEventListener("click", function () {
//   window.location.href = "login.html";
// });

//الاخفاء  من اول ميحمل
// AOS.init();


// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
let menuToggle = document.querySelector(".menu-toggle");
let menu = document.querySelector(".nav");
let icon = menuToggle.querySelector("i");

menuToggle.addEventListener("click", () => {
  menu.classList.toggle("active");
  icon.classList.toggle("fa-bars-staggered");
  icon.classList.toggle("fa-xmark");
});
//search
let searchBtn = document.getElementById("searchBtn"); // أيقونة البحث
let searchBox = document.getElementById("searchBox"); // مربع البحث
let closeBtn = document.getElementById("closeBtn"); // زر الإغلاق
let nav = document.querySelector("header .nav"); // قائمة التنقل
let icons = document.querySelector(".icons");
let person = document.querySelector(".bi-person");
let shop = document.querySelector(".bi-cart3");
let icon3 = document.getElementById("icon");

// إظهار مربع البحث وإخفاء قائمة الـ nav وأيقونة البحث
searchBtn.addEventListener("click", () => {

  if (shop) shop.style.display = "none";
  if (person) person.style.display = "none";
  if (icon3) icon3.style.display = "none";
  if (nav) nav.style.display = "none";

  searchBtn.style.display = "none";
  searchBox.style.display = "flex";
});
// إخفاء مربع البحث وإعادة عرض قائمة الـ nav وأيقونة البحث
closeBtn.addEventListener("click", () => {

  if (person) person.style.display = "flex";
  if (shop) shop.style.display = "flex";
  if (icon3) icon3.style.display = "flex";
  if (nav) nav.style.display = "flex";

  searchBox.style.display = "none";
  searchBtn.style.display = "block";
});
//sidebar
document.addEventListener("DOMContentLoaded", () => {
  let sidebar = document.getElementById("sidebar");
  let overlay = document.getElementById("overlay");
  let openBtn = document.getElementById("open-btn");
  let quick = document.querySelector(".quick-navigation");
  let toggles = document.querySelectorAll(".toggle");
  let mobileMenuBtn = document.getElementById("mobile-menu-btn");
  let categoriesBtn = document.getElementById("categories-btn");
  let mobileMenu = document.getElementById("mobile-menu");
  let categoriesMenu = document.getElementById("categories");

  openBtn.addEventListener("click", () => {
    sidebar.classList.add("open");
    overlay.style.display = "block";
  });

  quick.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.style.display = "none";
  });

  overlay.addEventListener("click", () => {
    sidebar.classList.remove("open");
    overlay.style.display = "none";
  });
  toggles.forEach((toggle) => {
    toggle.addEventListener("click", () => {
      let target = document.getElementById(toggle.dataset.target);
      let parentLink = toggle.parentElement;
      if (target.style.display === "block") {
        target.style.display = "none";
        toggle.textContent = "+";
        parentLink.classList.remove("active");
      } else {
        target.style.display = "block";
        toggle.textContent = "-";
        toggles.forEach((t) => t.parentElement.classList.remove("active"));

        // إضافة الكلاس إلى الرابط الحالي
        parentLink.classList.add("active");
      }
    });
  });
  mobileMenuBtn.addEventListener("click", () => {
    mobileMenuBtn.classList.add("active");
    categoriesBtn.classList.remove("active");
    mobileMenu.style.display = "block";
    categoriesMenu.style.display = "none";
  });

  categoriesBtn.addEventListener("click", () => {
    categoriesBtn.classList.add("active");
    mobileMenuBtn.classList.remove("active");
    categoriesMenu.style.display = "block";
    mobileMenu.style.display = "none";
  });

  // التعامل مع القوائم الفرعية
  document.addEventListener("DOMContentLoaded", () => {
    let toggles = document.querySelectorAll(".menu  .toggle");
    toggles.forEach((toggle) => {
      toggle.addEventListener("click", (event) => {
        event.stopPropagation(); // منع التفاعل مع الروابط الأب
        let targetId = toggle.dataset.target;
        let submenu = document.getElementById(targetId);

        if (submenu) {
          if (submenu.style.display === "block") {
            submenu.style.display = "none";
            toggle.textContent = "+";
          } else {
            submenu.style.display = "block";
            toggle.textContent = "-";
          }
        }

      });
    });
  });
});

function showTab(tabId) {
  // إزالة الـ active من جميع الأزرار
  document.querySelectorAll(".tab-button").forEach((button) => {
    button.classList.remove("active");
  });


  event.target.classList.add("active");

  document.querySelectorAll(".tab-content").forEach((content) => {
    content.style.display = "none"; // إخفاء جميع المحتويات
  });

  document.getElementById(tabId).style.display = "block"; // إظهار المحتوى المختار
}

document.addEventListener("DOMContentLoaded", function () {
  // button to activate the group
  const groups = document.querySelectorAll(".group");

  groups.forEach((group) => {
    group.addEventListener("click", () => {
      groups.forEach((g) => g.classList.remove("active"));
      group.classList.add("active");
    });

  });

});

  document.addEventListener("DOMContentLoaded", function () {
    const img = document.querySelector("#product-image");
    const lens = document.querySelector(".zoom-lens");
    const container = document.querySelector(".content-products .images");

    if (!img || !lens || !container) {

        return;
    }

    function moveLens(event) {
        let x, y;
        if (event.touches) {
            let touch = event.touches[0];
            x = touch.clientX;
            y = touch.clientY;
        } else {
            x = event.clientX;
            y = event.clientY;
        }

        let rect = img.getBoundingClientRect();
        let offsetX = x - rect.left;
        let offsetY = y - rect.top;

        let percentX = (offsetX / rect.width) * 100;
        let percentY = (offsetY / rect.height) * 100;

        lens.style.left = `${offsetX - lens.offsetWidth / 2}px`;
        lens.style.top = `${offsetY - lens.offsetHeight / 2}px`;
        lens.style.backgroundImage = `url('${img.src}')`;
        lens.style.backgroundPosition = `${percentX}% ${percentY}%`;
        lens.style.display = "block";
    }

    function hideLens() {
        lens.style.display = "none";
    }

    // إضافة الأحداث فقط إذا كان `container` موجودًا
    container.addEventListener("touchmove", moveLens);
    container.addEventListener("mousemove", moveLens);
    container.addEventListener("touchend", hideLens);
    container.addEventListener("mouseleave", hideLens);
});


const pages = {
  1: [
    {
      img: "images/Accessories1.jpg",
      alt: "Accessories1",
      category: "Accessories",
      title: "Elegant bracelet",
      price: "$30.00",
      gender: "women",
      shortDescription:
        "A pair of elegant bracelets – one adorned with timeless pearls, and the other a gold-toned beauty featuring pearls and a delicate rose at the center. A perfect touch of sophistication.",
      longDescription:
        "Add a touch of elegance to your style with this exquisite bracelet set. The first bracelet is crafted entirely from lustrous pearls, embodying classic sophistication. The second bracelet features a stunning gold-tone design, adorned with pearls and a delicate rose at the center, creating a charming and feminine look. Perfect for special occasions or elevating your everyday elegance.",
      ProductCode: "Acc-W-001",
      color: "#b8652e",
      colors: ["red", "blue", "black"] ,
      colorName:"Burnt Orange",
    },
    {
      img: "images/shoes10.png",
      alt: "shoes10",
      category: "Shoes",
      title: "Plain brown shoes",
      price: "$75.00",
      discount: "20%",
      gender: "women",
      shortDescription:
        "Classic men's shoes in beige and brown, offering a timeless and versatile style for any occasion.",
      longDescription:
        "Step into effortless style with these classic men's shoes in a refined beige and brown combination. Designed for both comfort and elegance, they feature a sleek and versatile look that pairs well with casual and formal outfits alike. Perfect for everyday wear or special occasions.",
      ProductCode: "Sho-W-002",
      color: "#9e694d",
      colors: ["red", "blue", "black"] ,
      colorName:"Rustic Clay",

    },
    {
      img: "images/clothing16.png",
      alt: "clothing16",
      category: "Clothing",
      title: "Two-tone dress",
      subcategory: "dresses",
      price: "$130.00",
      gender: "women",
      shortDescription:
        " Elegant two-tone maxi dress in olive green and beige, perfect for modest wear with a graceful and sophisticated look. ",
      longDescription:
        "Step into timeless elegance with this stunning two-tone maxi dress, designed for a modest and sophisticated style. Featuring a beautiful combination of olive green and beige, this dress offers a flowy and flattering silhouette, making it perfect for both casual outings and special occasions. A chic and versatile choice for hijab fashion. ",
      ProductCode: "Clot-W-003",
      color: "#aa9d8a",
      colors: ["red", "blue", "black"] ,
      colorName:"Pale Stone",

    },
    {
      img: "images/handbag3.png",
      alt: "handbag3",
      category: "HandBag",
      title: "Light brown women's bag",
      price: "$60.00",
      gender: "women",
      shortDescription:
        " Chic light brown mini bag with a delicate pearl-adorned brooch at the center, adding a touch of elegance to your style. ",
      longDescription:
        "Elevate your look with this stylish light brown mini bag, designed for elegance and practicality. Featuring a sleek compact design, it is adorned with a beautiful central brooch accented with a lustrous pearl, adding a refined and feminine touch. Perfect for both casual and dressy occasions.",
      ProductCode: "Hand-W-004",
      color: "#d0cac2",
      colors: ["red", "blue", "black"] ,
      colorName:"Misty Beige",

    },
    {
      img: "images/clothing12.png",
      alt: "clothing12",
      category: "Clothing",
      title: "Men's beige pants",
      subcategory: "pants",
      price: "$70.00",
      gender: "men",
      shortDescription:
        " Versatile men's pants in four solid colors – navy blue, light blue, black, and beige – for a classic and stylish look. ",
      longDescription:
        " Upgrade your wardrobe with these classic men's pants, available in four elegant solid colors: navy blue, light blue, black, and beige. Designed for comfort and versatility, they offer a perfect fit for both casual and formal occasions. A must-have staple for a refined and timeless style.",
      ProductCode: "Clot-M-005",
      color: ["#cfc0a3", "#282e46", "#b2b8b8","#505c4e","#222128"],
      colorNames: ["Pale Gold", "Dark Navy", "Silver Mist", "Olive Green","Dark Plum"], // أسماء الألوان
    },
    {
      img: "images/shoes2.png",
      alt: "shoes2",
      category: "Shoes",
      title: "Blue and brown shoes",
      price: "$90.00",
      gender: "men",
      shortDescription:
        "Stylish men's shoes in blue and brown, inspired by the classic sneaker design for a trendy and comfortable look.",
      longDescription:
        "Step up your style with these blue and brown men's shoes, featuring a design reminiscent of classic high-top sneakers. Combining comfort with a modern aesthetic, they are perfect for casual outings and everyday wear. A versatile addition to any wardrobe.",
      ProductCode: "Sho-M-006",
      color: "#343b35",
      colors: ["red", "blue", "black"] ,
      colorName:"Dark Forest Green",
    },
    {
      img: "images/glasses1.png",
      alt: "glasses1",
      category: "Glasses",
      title: "Men's glasses",
      price: "$30.00",
      gender: "men",
      shortDescription:
        " Stylish men's glasses with a brown frame and sleek black lenses for a timeless and modern look.",
      longDescription:
        "Elevate your style with these classic men's glasses featuring a rich brown frame and bold black lenses. Designed for both fashion and functionality, they offer a sophisticated and versatile look suitable for any occasion. Perfect for adding a refined touch to your everyday outfit.",
      ProductCode: "Glass-M-007",
      color: "#474141",
      colors: ["red", "blue", "black"] ,
      colorName:"Charcoal Brown",
    },
    {
      img: "images/clothing11.png",
      alt: "clothing11",
      category: "Clothing",
      title: "Distinctive shirt",
      price: "$50.00",
      subcategory: "shirts",
      discount: "10%",
      gender: "men",
      shortDescription:
        "Stylish and distinctive men's shirt in four colors, featuring two side pockets for a modern and practical look. ",
      longDescription:
        "Upgrade your wardrobe with this unique four-tone men's shirt, designed for both style and functionality. Featuring two convenient side pockets, this shirt blends classic elegance with a modern touch. Perfect for casual and semi-formal occasions, offering comfort and versatility in every wear.",
      ProductCode: "Clot-M-008",
      color: ["#1c1b1f", "#979ea4", "#8f8061","#555559"],

      colorNames: ["Deep Charcoal", "Slate Gray", "Golden Taupe", "Olive Gray"], // أسماء الألوان
    },
    {
      img: "images/clothing24.png",
      alt: "clothing24",
      category: "Clothing",
      title: "Dress with bow",
      price: "$120.00",
      subcategory: "dresses",
      discount: "15%",
      gender: "women",
      shortDescription:
        " Elegant solid-colored silk dress featuring a chic bow detail for a sophisticated and graceful look. ",
      longDescription:
        "Embrace timeless elegance with this luxurious solid silk dress, designed for a sleek and refined appearance. The delicate bow accent adds a touch of femininity, making it perfect for special occasions or an effortlessly classy everyday style. Soft, smooth, and effortlessly graceful.",
      ProductCode: "Clot-W-009",
      color: "#b6937f",
      colors: ["red", "blue", "black"] ,
      colorName:"Warm Sand",
    },
    {
      img: "images/makeup2.png",
      alt: "makeup2",
      category: "MakeUp",
      title: "Foundation brand",
      price: "$35.00",
      gender: "women",
      shortDescription:
        "Long-lasting waterproof foundation in a new, sleek packaging for flawless coverage all day. ",
      longDescription:
        "Discover the ultimate beauty essential with our newly packaged waterproof foundation. Designed for all-day wear, it provides seamless coverage, a smooth finish, and resistance to water and humidity. Perfect for a flawless, long-lasting look in any condition.",
      ProductCode: "Make-W-010",
      color: ["#F1E1C6", " #D1B29C", " #F1C27D","#D18F6A"," #C97B4F"  ,"#6D4C41"],
      colorNames: ["Ivory", "Beige", "Golden Beige", "Tan" ,"Golden Tan" ,"Deep Brown"], // أسماء الألوان
    },

    {
      img: "images/Accessories2.png",
      alt: "Accessories4",
      category: "Accessories",
      title: "necklace chain",
      price: "$40.00",
      gender: "women",
      shortDescription:
        "Elegant silver necklace chain featuring a delicate brooch with a heart-shaped centerpiece for a timeless and romantic touch.",
      longDescription:
        "Add a touch of elegance to your look with this stunning silver necklace chain. Designed with a beautifully crafted brooch, it showcases a heart-shaped centerpiece that exudes charm and sophistication. Perfect for everyday wear or special occasions, making it a meaningful and stylish accessory.",
      ProductCode: "Acc-W-011",
      color: "#a5989e",
      colors: ["red", "blue", "black"] ,
      colorName:"Dusty Lavender",
    },
    {
      img: "images/glasses6.png",
      alt: "glasses6",
      category: "Glasses",
      title: "Fashionable women's glasses",
      price: "$55.00",
      gender: "women",
      shortDescription:
        " Trendy pink women's glasses with a stylish, fashion-forward design for a bold and elegant look. ",
      longDescription:
        "Stay ahead of the fashion game with these chic pink women's glasses, designed to blend modern trends with timeless elegance. Featuring a sleek and contemporary frame, they add a touch of sophistication to any outfit. Perfect for fashion lovers who want to make a stylish statement.",
      ProductCode: "Glass-W-012",
      color: "#e0896d",
      colors: ["red", "blue", "black"] ,
      colorName:"Peachy Orange",
    },
    {
      img: "images/handbag5.png",
      alt: "handbag5",
      category:"HandBag",
      title: "formal bag",
      price: "$77.00",
      gender: "men",
      shortDescription:
        " Elegant large formal bag with a matching wallet for a sophisticated and practical style. ",
      longDescription:
        "Upgrade your accessories with this stylish large formal bag, designed for elegance and functionality. Featuring a spacious interior for all your essentials, it comes with a matching wallet for added convenience. Perfect for work, events, or everyday sophistication.",
      ProductCode: "Hand-M-013",
      color: "#39342b",
      colors: ["red", "blue", "black"] ,
      colorName:"shadowed Forest",
    },

    {
      img: "images/Accessories25.png",
      alt: "Accessories25",
      category: "Accessories",
      title: "Excellent quality leather belt",
      subcategory: "Belts",
      price: "$30.00",
      gender: "men",
      shortDescription:
        " Premium quality leather belt with a strong and durable design for a timeless and refined look.",
      longDescription:
        "Experience the perfect blend of durability and elegance with this high-quality leather belt. Crafted from premium materials, it offers a strong and sturdy design, ensuring long-lasting wear and a sophisticated finish. Ideal for both casual and formal outfits.e",
      ProductCode: "Acc-W-014",
      color: "#03090b",
      colors: ["red", "blue", "black"] ,
      colorName:"Midnight Black",
    },
    {
      img: "images/clothing27.png",
      alt: "clothing27",
      category: "Clothing",
      title: "Full suit classy",
      subcategory: "suit",
      price: "$230.00",
      gender: "men",
      shortDescription:
        "Elegant six-piece gray suit set, including a shirt, vest, jacket, pants, bow tie, and pocket square for a complete classy look.",
      longDescription:
        "Step into sophistication with this refined five-piece gray suit set, perfect for formal occasions. This set includes a tailored jacket, matching pants, a stylish vest, a crisp shirt, a sleek bow tie, and a coordinating pocket square. Designed for elegance and comfort, it’s the ultimate choice for a distinguished and polished appearance.",
      ProductCode: "Clot-M-015",
      color: "#33312f",
      colors: ["red", "blue", "black"] ,
      colorName:"Dark Espresso",
    },
    {
      img: "images/shoes5.png",
      alt: "shoes5",
      category: "Shoes",
      title: "comfortable shoes",
      price: "$80.00",
      discount: "20%",
      gender: "men",
      shortDescription:
        " Stylish and comfortable men's shoes in gray and white, perfect for all-day wear. ",
      longDescription:
        "Upgrade your footwear collection with these sleek gray and white men's shoes, designed for ultimate comfort and modern style. Featuring a lightweight and breathable design, they provide excellent support for everyday wear, whether casual or sporty. A perfect blend of fashion and function.",
      ProductCode: "Sho-M-016",
      color: "#8e8c8a",
      colors: ["red", "blue", "black"] ,
      colorName:"Sandy Gray",
    },
  ],
  
};
// export { pages };

document.addEventListener("DOMContentLoaded", function () {
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get("id");

  if (productId) {
    let product;
    for (let page in pages) {
      product = pages[page].find((p) => p.ProductCode === productId);
      if (product) break;
    }

    if (product) {
      // تحديث عناصر الصفحة
      document.getElementById("product-image").src = product.img;
      document.getElementById("product-image").alt = product.alt;
      document.getElementById("product-title").textContent = product.title;
      document.getElementById("product-description").textContent = product.shortDescription;
      document.getElementById("product-price").textContent = product.price;
      document.getElementById("product-sku").textContent = product.ProductCode;
      document.getElementById("description").textContent = product.longDescription;

      // تحديث الزر "Add to Cart" مع الـ data-id الخاص بالمنتج
      const addToCartButton = document.querySelector(".shopping-cart");
      if (addToCartButton) {
        addToCartButton.setAttribute("data-id", product.ProductCode); // تعيين الـ ProductCode الصحيح للـ Cart
      }

      // تحديث الزر "Add to Wishlist" مع الـ data-product-id الخاص بالمنتج
      const addToWishlistButton = document.querySelector(".wishlist-button");
      if (addToWishlistButton) {
        addToWishlistButton.setAttribute("data-product-id", product.ProductCode); // تعيين الـ ProductCode للـ Wishlist
      }



      // تحديث الفئة (Category) مع الرابط
      const categoryElement = document.querySelector(".tags p:nth-child(2) a");
      if (categoryElement) {
        categoryElement.textContent = product.category;
        categoryElement.href = `products.html?category=${encodeURIComponent(product.category)}`;
      }

      // إخفاء الحجم إذا كان المنتج من فئة معينة
      const sizeLabel = document.getElementById("size-label");
      const sizeSelect = document.getElementById("size");

      if (["Accessories", "Glasses", "MakeUp", "HandBag"].includes(product.category)) {
        sizeLabel.style.display = "none";
        sizeSelect.style.display = "none";
      } else {
        sizeLabel.style.display = "block";
        sizeSelect.style.display = "block";

        // تحديث خيارات الحجم بناءً على الجنس والفئة
        if (product.category === "Shoes" && product.gender === "women") {
          // أحذية نسائية
          sizeSelect.innerHTML = `
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
          `;
        } else if (product.category === "Shoes" && product.gender === "men") {
          // أحذية رجالية
          sizeSelect.innerHTML = `
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
          `;
        } else if (product.gender === "men") {
          // ملابس رجالية
          sizeSelect.innerHTML = `
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
            <option value="XXXL">XXXL</option>
            <option value="XXXXL">XXXXL</option>
          `;
        } else {
          // المقاسات الافتراضية
          sizeSelect.innerHTML = `
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
            <option value="XXL">XXL</option>
          `;
        }
      }


      // تغيير اللون واسم اللون بناءً على الألوان المتاحة للمنتج
      const colorOptionsContainer = document.getElementById("color-options");
      const selectedColorSpan = document.getElementById("selected-color");

      // تحقق من إذا كان هناك أكثر من لون
      if (Array.isArray(product.color) && product.color.length > 1) {
        // إذا كان هناك ألوان متعددة، أنشئ دوائر الألوان
        product.color.forEach((color, index) => {
          const colorCircle = document.createElement("div");
          colorCircle.classList.add("color-circle");
          colorCircle.style.backgroundColor = color;
          colorCircle.dataset.color = color;

          // إضافة الحدث لتغيير اللون عند النقر
          colorCircle.addEventListener("click", function () {
            selectedColorSpan.textContent = product.colorNames ? product.colorNames[index] : `Color ${index + 1}`;
            selectedColorSpan.style.color = color;
          });

          // إضافة الدائرة إلى الـ DOM
          colorOptionsContainer.appendChild(colorCircle);
        });

        // إذا كان يوجد لون افتراضي، يتم تحديده بشكل مسبق
        selectedColorSpan.textContent = product.colorNames ? product.colorNames[0] : `Color 1`;
        selectedColorSpan.style.color = product.color[0];
      } else if (typeof product.color === "string") {
        // إذا كان هناك لون واحد فقط (وليس مصفوفة)
        const color = product.color;
        const colorCircle = document.createElement("div");
        colorCircle.classList.add("color-circle");
        colorCircle.style.backgroundColor = color;
        colorCircle.dataset.color = color;

        // إضافة الحدث لتغيير اللون عند النقر
        colorCircle.addEventListener("click", function () {
          selectedColorSpan.textContent = product.colorName || "Color 1";
          selectedColorSpan.style.color = color;
        });

        // إضافة الدائرة إلى الـ DOM
        colorOptionsContainer.appendChild(colorCircle);

        // تعيين اللون الافتراضي
        selectedColorSpan.textContent = product.colorName || "Color 1";
        selectedColorSpan.style.color = color;
      }
    } else {
      console.error("Product not found");
    }
  }

});


const itemsPerPage = 6;
const totalPages = 6;
const maxPages = 3;

function goToPage(page) {
  currentPage = page;
  renderPage();
  updatePagination();
}

// التوجه إلى الصفحة السابقة
function prevPage() {
  if (currentPage > 1) {
    currentPage--;
    renderPage();
    updatePagination();
  }
}

// التوجه إلى الصفحة التالية
function nextPage() {
  if (currentPage < totalPages) {
    currentPage++;
    renderPage();
    updatePagination();
  }
}


function updatePagination() {
  const paginationNumbers = document.getElementById("pagination-numbers");

  paginationNumbers.innerHTML = "";

  let startPage = Math.max(1, currentPage - Math.floor(maxPages / 2));
  let endPage = Math.min(totalPages - 1, startPage + maxPages - 1);

  if (endPage - startPage + 1 < maxPages) {
    startPage = Math.max(1, endPage - maxPages + 1);
  }

  for (let i = startPage; i <= endPage; i++) {
    const pageNumber = document.createElement("span");
    pageNumber.textContent = i;
    pageNumber.classList.add("page-number");

    // تمييز الرقم الحالي
    if (i === currentPage) {
      pageNumber.classList.add("active");
    }

    // إضافة حدث للنقر
    pageNumber.addEventListener("click", () => goToPage(i));

    paginationNumbers.appendChild(pageNumber);
  }

  // إضافة "..." فقط إذا كانت هناك صفحات مخفية قبل الرقم الأخير
  if (endPage < totalPages - 1) {
    const dots = document.createElement("span");
    dots.textContent = "...";
    dots.classList.add("dots");
    paginationNumbers.appendChild(dots);
  }
  const lastPage = document.createElement("span");
  lastPage.textContent = totalPages;
  lastPage.classList.add("page-number");

  // تمييز الرقم الأخير إذا كانت الصفحة هي الأخيرة
  if (currentPage === totalPages) {
    lastPage.classList.add("active");
  }

  lastPage.addEventListener("click", () => goToPage(totalPages));
  paginationNumbers.appendChild(lastPage);

  // إخفاء أو إظهار أزرار "التالي" و "السابق"
  document.getElementById("prev-btn").style.display =
    currentPage === 1 ? "none" : "inline-block";
  document.getElementById("next-btn").style.display =
    currentPage === totalPages ? "none" : "inline-block";
}

// function renderPage() {
//   changePage(currentPage);
// }

// ===============================

// main.js
document.querySelectorAll('.add-to-cart-button').forEach(button => {
  button.addEventListener('click', (event) => {
      addProductToCart(event);  // استدعاء دالة من ملف products.js
  });
});

document.querySelectorAll('.add-to-wishlist-button').forEach(button => {
  button.addEventListener('click', (event) => {
      addProductToWishlist(event);  // استدعاء دالة من ملف products.js
  });
});
// =================================
// function changePage(page) {
//   const container = document.getElementById("product-container");
//   container.innerHTML = ""; // مسح المحتوى الحالي

//   pages[page].forEach((product) => {
//     const productDiv = document.createElement("div");
//     productDiv.classList.add("image");
//     productDiv.innerHTML = `
//         <a href="details.html?id=${product.ProductCode}">
//           <img src="${product.img}" alt="${product.alt}">
//         </a>
//         <div class="content">
//         <a href="products.html?category=${product.category}">${product.category}</a>
//           <h2>${product.title}</h2>
//           <span>${product.price}</span>
//         </div>
//         <div class="event" data-product-id="${product.ProductCode}">
//             <a onclick="addProductToCart(event)">
//                 <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
//             </a>
//             <a onclick="addProductToWishlist(event)" data-product-id="${product.ProductCode}">
//                 <i class="fas fa-heart" data-text="WatchList"></i>
//             </a>
//         </div>
//         ${
//           product.discount
//             ? `<div class="discount">${product.discount}</div>`
//             : ""
//         }
//       `;
//     container.appendChild(productDiv);
//   });
// }

document.addEventListener("DOMContentLoaded", function () {

    renderPage();
    updatePagination();
    changePage(1);
  });



document.addEventListener("DOMContentLoaded", function () {
  // استخراج الفئة من رابط الصفحة
  const urlParams = new URLSearchParams(window.location.search);
  const selectedCategory = urlParams.get("category");

  if (selectedCategory) {
    filterProductsByCategory(selectedCategory);
  }
});
// ========================================
//فلترة الكاتيجوريز
function filterProductsByCategory(category) {
  const productContainer = document.getElementById("product-container");
  const paginationNumbers = document.getElementById("pagination-numbers");
  const prevBtn = document.getElementById("prev-btn");
  const nextBtn = document.getElementById("next-btn");

  productContainer.innerHTML = ""; // مسح المنتجات القديمة

  const allProducts = Object.values(pages).flat(); // جمع كل المنتجات
  const filteredProducts = allProducts.filter(
    (product) => product.category === category
  );

  // إخفاء الباجينيشن وأزرار التنقل عند الفلترة
  paginationNumbers.style.display = "none";
  prevBtn.style.display = "none";
  nextBtn.style.display = "none";

  displayProducts(filteredProducts);
}

// ========================================


function displayProducts(products) {
  const productContainer = document.getElementById("product-container");
  productContainer.innerHTML = "";

  products.forEach((product) => {
    const productElement = `
        <div class="image">
          <a href="details.html?id=${product.ProductCode}">
            <img src="${product.img}" alt="${product.alt}" />
          </a>
          <div class="content">
            <a href="products.html?category=${product.category}">${product.category}</a>
            <h2>${product.title}</h2>
            <span>${product.price}</span>
          </div>
          <div class="event" data-product-id="${product.ProductCode}">
            <a onclick="addProductToCart(event)">
                <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
            </a>
            <a onclick="addProductToWishlist(event)" data-product-id="${product.ProductCode}">
                <i class="fas fa-heart" data-text="WatchList"></i>
            </a>
        </div>
          ${
            product.discount
              ? `<div class="discount">-${product.discount}</div>`
              : ""
          }
        </div>
    `;
    productContainer.innerHTML += productElement;
  });

}
// تحميل الصفحة الأولى عند فتح الموقع



function filterProductsByGenderCategoryAndSubcategory(gender = "all", category = "all", subCategory = "all") {
  const productContainer = document.getElementById("product-container");
  const paginationNumbers = document.getElementById("pagination-numbers");
  const prevBtn = document.getElementById("prev-btn");
  const nextBtn = document.getElementById("next-btn");

  const allProducts = Object.values(pages).flat();

  const filteredProducts = allProducts.filter((product) => {
    const matchesGender =
      gender.toLowerCase() === "all" ||
      (product.gender && product.gender.toLowerCase() === gender.toLowerCase());

    const matchesCategory =
      category.toLowerCase() === "all" ||
      product.category.toLowerCase() === category.toLowerCase();

    const matchesSubCategory =
      subCategory.toLowerCase() === "all" ||
      (product.subcategory && product.subcategory.toLowerCase() === subCategory.toLowerCase());

    return matchesGender && matchesCategory && matchesSubCategory;
  });

  // مسح المنتجات الحالية
  productContainer.innerHTML = "";


  if (filteredProducts.length === 0) {
    productContainer.innerHTML = "<p>No products found matching the filters.</p>";

    // **إخفاء الباجينيشن وأزرار التصفح بشكل صحيح عند عدم وجود منتجات**
    paginationNumbers.style.display = "none";
    prevBtn.style.display = "none";
    nextBtn.style.display = "none";
    return; // خروج مبكر لتجنب أي عمليات إضافية
  }

  // عرض المنتجات المصفاة
  filteredProducts.forEach((product) => {
    const productElement = `
      <div class="image">
        <a href="details.html?id=${product.ProductCode}">
          <img src="${product.img}" alt="${product.alt}" />
        </a>
        <div class="content">
          <a href="products.html?category=${product.category}">${product.category}</a>
          <h2>${product.title}</h2>
          <span>${product.price}</span>
        </div>
        <div class="event" data-product-id="${product.ProductCode}">
            <a onclick="addProductToCart(event)">
                <i class="fas fa-cart-plus" data-text="Add To Cart"></i>
            </a>
            <a onclick="addProductToWishlist(event)" data-product-id="${product.ProductCode}">
                <i class="fas fa-heart" data-text="WatchList"></i>
            </a>
        </div>
        ${product.discount ? `<div class="discount">-${product.discount}%</div>` : ""}
      </div>
    `;
    productContainer.innerHTML += productElement;
  });


if (filteredProducts.length < 50 ||
  (gender.toLowerCase() === "all" && category.toLowerCase() === "all" && subCategory.toLowerCase() === "all")) {
 paginationNumbers.style.display = "none";
 prevBtn.style.display = "none";
 nextBtn.style.display = "none";
} else {
 paginationNumbers.style.display = "block";
 prevBtn.style.display = "inline-block";
 nextBtn.style.display = "inline-block";
 updatePagination(); // تحديث التصفح
}

}
// إضافة خاصية الطي/الفتح للقوائم الفرعية
document.querySelectorAll(".toggle").forEach((toggle) => {
  toggle.addEventListener("click", () => {
    const target = document.getElementById(toggle.dataset.target);
    target.classList.toggle("open");
    toggle.textContent = target.classList.contains("open") ? "-" : "+";
  });
});

