<!doctype html>
<html lang="en" class="h-full">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Raza Boiler Poultry &amp; Chicken Shop</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- <script src="/assets/js/element_sdk.js"></script> -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&amp;family=DM+Sans:wght@400;500;600;700&amp;display=swap" rel="stylesheet">
  <style>
    body {
      box-sizing: border-box;
    }
    .font-display { font-family: 'Playfair Display', serif; }
    .font-body { font-family: 'DM Sans', sans-serif; }
    
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .animate-float { animation: float 3s ease-in-out infinite; }
    .animate-fade-in { animation: fadeInUp 0.8s ease-out forwards; }
    .animate-delay-1 { animation-delay: 0.2s; opacity: 0; }
    .animate-delay-2 { animation-delay: 0.4s; opacity: 0; }
    .animate-delay-3 { animation-delay: 0.6s; opacity: 0; }
    
    .hero-gradient {
      background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
    }
    
    .card-shine {
      background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
    }
  </style>
  <style>@view-transition { navigation: auto; }</style>
  /* <script src="/assets/js/data_sdk.js" type="text/javascript"></script> */
 </head>
 <body class="h-full font-body">
  <div id="app-wrapper" class="w-full h-full overflow-auto"><!-- Admin Access Modal -->
   <div id="admin-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 md:p-12 max-w-md w-full mx-4 shadow-2xl">
     <div class="text-center mb-8">
      <div class="w-16 h-16 bg-[#e63946]/10 rounded-2xl flex items-center justify-center mx-auto mb-4"><span class="text-4xl">🔐</span>
      </div>
      <h2 class="font-display text-2xl md:text-3xl text-gray-800 font-bold">Admin Access</h2>
      <p class="text-gray-600 mt-2">Enter your access code to continue</p>
     </div>
     <form id="admin-form" class="space-y-4">
      <div><label class="block text-gray-700 font-semibold mb-2">Access Code</label> <input type="text" id="admin-code-input" placeholder="Enter 6-digit code" maxlength="6" required class="w-full px-5 py-4 rounded-xl border-2 border-gray-200 text-gray-800 placeholder-gray-400 focus:outline-none focus:border-[#e63946] transition-colors text-center text-lg tracking-widest font-mono">
      </div><button type="submit" class="w-full bg-[#e63946] hover:bg-[#ff6b6b] text-white py-4 rounded-xl font-bold text-lg transition-all transform hover:scale-[1.02]"> 🔓 Access Admin Panel </button> <button type="button" id="cancel-admin-btn" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 py-4 rounded-xl font-bold text-lg transition-all"> Cancel </button>
      <p id="admin-error" class="hidden text-center text-red-500 font-semibold"></p>
     </form>
    </div>
   </div><!-- Admin Panel -->
   <div id="admin-panel" class="hidden fixed inset-0 z-[100] bg-[#1a1a2e] overflow-auto">
    <div class="max-w-6xl mx-auto px-4 py-8"><!-- Admin Header -->
     <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 mb-8 flex items-center justify-between border border-white/10">
      <div class="flex items-center gap-4">
       <div class="w-12 h-12 bg-[#e63946] rounded-2xl flex items-center justify-center"><span class="text-2xl">👨‍💼</span>
       </div>
       <div>
        <h1 class="font-display text-2xl text-white font-bold">Admin Dashboard</h1>
        <p class="text-gray-400 text-sm">Manage your shop and orders</p>
       </div>
      </div><button id="logout-btn" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl font-semibold transition-all border border-white/20"> 🚪 Logout </button>
     </div><!-- Stats Grid -->
     <div class="grid md:grid-cols-3 gap-6 mb-8">
      <div class="bg-gradient-to-br from-[#e63946] to-[#ff6b6b] rounded-3xl p-6 text-white">
       <div class="flex items-center justify-between mb-4"><span class="text-4xl">📦</span> <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-semibold">Today</span>
       </div>
       <div class="text-3xl font-bold mb-1">
        24
       </div>
       <div class="text-white/80">
        Total Orders
       </div>
      </div>
      <div class="bg-gradient-to-br from-[#4ade80] to-[#22c55e] rounded-3xl p-6 text-white">
       <div class="flex items-center justify-between mb-4"><span class="text-4xl">💰</span> <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-semibold">Today</span>
       </div>
       <div class="text-3xl font-bold mb-1">
        ₹12,450
       </div>
       <div class="text-white/80">
        Revenue
       </div>
      </div>
      <div class="bg-gradient-to-br from-[#3b82f6] to-[#2563eb] rounded-3xl p-6 text-white">
       <div class="flex items-center justify-between mb-4"><span class="text-4xl">⏱️</span> <span class="bg-white/20 px-3 py-1 rounded-full text-sm font-semibold">Pending</span>
       </div>
       <div class="text-3xl font-bold mb-1">
        5
       </div>
       <div class="text-white/80">
        Deliveries
       </div>
      </div>
     </div><!-- Recent Orders -->
     <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 md:p-8 border border-white/10">
      <h2 class="font-display text-xl text-white font-bold mb-6">Recent Orders</h2>
      <div class="space-y-4">
       <div class="bg-white/5 rounded-2xl p-4 hover:bg-white/10 transition-all border border-white/10">
        <div class="flex items-center justify-between mb-3">
         <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-[#4ade80]/20 rounded-xl flex items-center justify-center"><span class="text-lg">👤</span>
          </div>
          <div>
           <div class="text-white font-semibold">
            Ahmed Khan
           </div>
           <div class="text-gray-400 text-sm">
            +91 98765 12345
           </div>
          </div>
         </div><span class="bg-[#4ade80]/20 text-[#4ade80] px-3 py-1 rounded-full text-sm font-semibold">Delivered</span>
        </div>
        <div class="text-gray-300 text-sm mb-2">
         2kg Whole Chicken, 1kg Boneless
        </div>
        <div class="flex items-center justify-between"><span class="text-white font-bold">₹980</span> <span class="text-gray-400 text-sm">10 mins ago</span>
        </div>
       </div>
       <div class="bg-white/5 rounded-2xl p-4 hover:bg-white/10 transition-all border border-white/10">
        <div class="flex items-center justify-between mb-3">
         <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-[#3b82f6]/20 rounded-xl flex items-center justify-center"><span class="text-lg">👤</span>
          </div>
          <div>
           <div class="text-white font-semibold">
            Fatima Sheikh
           </div>
           <div class="text-gray-400 text-sm">
            +91 98765 67890
           </div>
          </div>
         </div><span class="bg-[#3b82f6]/20 text-[#3b82f6] px-3 py-1 rounded-full text-sm font-semibold">Processing</span>
        </div>
        <div class="text-gray-300 text-sm mb-2">
         3kg Curry Cut, 20 Eggs
        </div>
        <div class="flex items-center justify-between"><span class="text-white font-bold">₹920</span> <span class="text-gray-400 text-sm">25 mins ago</span>
        </div>
       </div>
       <div class="bg-white/5 rounded-2xl p-4 hover:bg-white/10 transition-all border border-white/10">
        <div class="flex items-center justify-between mb-3">
         <div class="flex items-center gap-3">
          <div class="w-10 h-10 bg-[#f59e0b]/20 rounded-xl flex items-center justify-center"><span class="text-lg">👤</span>
          </div>
          <div>
           <div class="text-white font-semibold">
            Salman Raza
           </div>
           <div class="text-gray-400 text-sm">
            +91 98765 11111
           </div>
          </div>
         </div><span class="bg-[#f59e0b]/20 text-[#f59e0b] px-3 py-1 rounded-full text-sm font-semibold">Out for Delivery</span>
        </div>
        <div class="text-gray-300 text-sm mb-2">
         1.5kg Boneless Breast
        </div>
        <div class="flex items-center justify-between"><span class="text-white font-bold">₹510</span> <span class="text-gray-400 text-sm">1 hour ago</span>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div><!-- Navigation -->
   <nav class="fixed top-0 left-0 right-0 z-50 bg-[#1a1a2e]/95 backdrop-blur-sm border-b border-[#e63946]/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
     <div class="flex items-center justify-between h-16">
      <div class="flex items-center gap-3">
       <div class="w-10 h-10 bg-gradient-to-br from-[#e63946] to-[#ff6b6b] rounded-full flex items-center justify-center"><span class="text-xl">🐔</span>
       </div><span id="nav-shop-name" class="font-display text-xl text-white font-bold">Raza Boiler</span>
      </div>
      <div class="hidden md:flex items-center gap-8"><a href="#products" class="text-gray-300 hover:text-[#e63946] transition-colors font-medium">Products</a> <a href="#about" class="text-gray-300 hover:text-[#e63946] transition-colors font-medium">About</a> <a href="#contact" class="text-gray-300 hover:text-[#e63946] transition-colors font-medium">Contact</a> <a href="#order" class="bg-[#e63946] hover:bg-[#ff6b6b] text-white px-5 py-2 rounded-full font-semibold transition-all transform hover:scale-105"> Order Now </a> <button id="admin-access-btn" class="bg-white/10 hover:bg-white/20 text-white px-4 py-2 rounded-full font-semibold transition-all border border-white/20 flex items-center gap-2"> 🔐 Admin </button>
      </div>
     </div>
    </div>
   </nav><!-- Hero Section -->
   <section class="hero-gradient min-h-[600px] pt-24 pb-16 px-4 relative overflow-hidden"><!-- Decorative Elements -->
    <div class="absolute top-20 right-10 text-6xl opacity-20 animate-float">
     🍗
    </div>
    <div class="absolute bottom-20 left-10 text-5xl opacity-20 animate-float" style="animation-delay: 1s;">
     ��
    </div>
    <div class="absolute top-40 left-1/4 text-4xl opacity-10 animate-float" style="animation-delay: 0.5s;">
     ✨
    </div>
    <div class="max-w-7xl mx-auto relative z-10">
     <div class="grid md:grid-cols-2 gap-12 items-center">
      <div class="text-center md:text-left">
       <div class="inline-flex items-center gap-2 bg-[#e63946]/20 border border-[#e63946]/30 rounded-full px-4 py-2 mb-6 animate-fade-in"><span class="w-2 h-2 bg-[#4ade80] rounded-full animate-pulse"></span> <span class="text-[#4ade80] text-sm font-semibold">Fresh Daily Delivery</span>
       </div>
       <h1 id="hero-title" class="font-display text-4xl md:text-6xl text-white font-bold leading-tight mb-6 animate-fade-in animate-delay-1">Farm Fresh Chicken<br><span class="text-[#e63946]">Delivered to You</span></h1>
       <p id="hero-subtitle" class="text-gray-300 text-lg md:text-xl mb-8 max-w-lg animate-fade-in animate-delay-2">Premium quality poultry from Raza Boiler. Hygienically processed, delivered fresh to your doorstep within hours.</p>
       <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start animate-fade-in animate-delay-3"><a href="#order" class="bg-[#e63946] hover:bg-[#ff6b6b] text-white px-8 py-4 rounded-full font-bold text-lg transition-all transform hover:scale-105 hover:shadow-lg hover:shadow-[#e63946]/30"> 🛒 Order Fresh Chicken </a> <a href="tel:+911234567890" id="hero-phone-btn" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-8 py-4 rounded-full font-bold text-lg transition-all flex items-center justify-center gap-2"> 📞 Call Now </a>
       </div>
      </div><!-- Hero Visual -->
      <div class="relative flex justify-center">
       <div class="w-72 h-72 md:w-96 md:h-96 bg-gradient-to-br from-[#e63946]/30 to-[#ff6b6b]/10 rounded-full flex items-center justify-center relative">
        <div class="absolute inset-4 bg-gradient-to-br from-[#e63946]/20 to-transparent rounded-full"></div>
        <div class="text-[120px] md:text-[180px] animate-float">
         🍗
        </div><!-- Floating Badges -->
        <div class="absolute -top-4 -right-4 bg-white rounded-2xl p-3 shadow-xl animate-float" style="animation-delay: 0.3s;">
         <div class="flex items-center gap-2"><span class="text-2xl">✅</span>
          <div>
           <div class="font-bold text-gray-800 text-sm">
            100%
           </div>
           <div class="text-gray-500 text-xs">
            Halal
           </div>
          </div>
         </div>
        </div>
        <div class="absolute -bottom-4 -left-4 bg-white rounded-2xl p-3 shadow-xl animate-float" style="animation-delay: 0.6s;">
         <div class="flex items-center gap-2"><span class="text-2xl">🚚</span>
          <div>
           <div class="font-bold text-gray-800 text-sm">
            Fast
           </div>
           <div class="text-gray-500 text-xs">
            Delivery
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section><!-- Products Section -->
   <section id="products" class="bg-[#f8f9fa] py-20 px-4">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16"><span class="text-[#e63946] font-semibold text-sm uppercase tracking-wider">Our Products</span>
      <h2 class="font-display text-3xl md:text-5xl text-gray-800 font-bold mt-2">Fresh &amp; Quality Chicken</h2>
      <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Hygienically processed and delivered fresh. Choose from our wide range of premium poultry products.</p>
     </div>
     <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6"><!-- Product Card 1 -->
      <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
       <div class="h-48 bg-gradient-to-br from-[#fff5f5] to-[#ffe3e3] flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[#e63946]/5 group-hover:bg-[#e63946]/10 transition-colors"></div><span class="text-7xl group-hover:scale-110 transition-transform">🍗</span>
       </div>
       <div class="p-6">
        <h3 class="font-display text-xl font-bold text-gray-800 mb-2">Whole Chicken</h3>
        <p class="text-gray-500 text-sm mb-4">Fresh whole chicken, cleaned &amp; ready to cook</p>
        <div class="flex items-center justify-between"><span class="text-[#e63946] font-bold text-xl">₹220/kg</span> <button class="bg-[#e63946]/10 hover:bg-[#e63946] text-[#e63946] hover:text-white p-3 rounded-full transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg></button>
        </div>
       </div>
      </div><!-- Product Card 2 -->
      <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
       <div class="h-48 bg-gradient-to-br from-[#fff5f5] to-[#ffe3e3] flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[#e63946]/5 group-hover:bg-[#e63946]/10 transition-colors"></div><span class="text-7xl group-hover:scale-110 transition-transform">🥩</span>
       </div>
       <div class="p-6">
        <h3 class="font-display text-xl font-bold text-gray-800 mb-2">Boneless Breast</h3>
        <p class="text-gray-500 text-sm mb-4">Premium boneless chicken breast cuts</p>
        <div class="flex items-center justify-between"><span class="text-[#e63946] font-bold text-xl">₹340/kg</span> <button class="bg-[#e63946]/10 hover:bg-[#e63946] text-[#e63946] hover:text-white p-3 rounded-full transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg></button>
        </div>
       </div>
      </div><!-- Product Card 3 -->
      <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
       <div class="h-48 bg-gradient-to-br from-[#fff5f5] to-[#ffe3e3] flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[#e63946]/5 group-hover:bg-[#e63946]/10 transition-colors"></div><span class="text-7xl group-hover:scale-110 transition-transform">🦴</span>
       </div>
       <div class="p-6">
        <h3 class="font-display text-xl font-bold text-gray-800 mb-2">Curry Cut</h3>
        <p class="text-gray-500 text-sm mb-4">Perfect pieces for delicious curries</p>
        <div class="flex items-center justify-between"><span class="text-[#e63946] font-bold text-xl">₹260/kg</span> <button class="bg-[#e63946]/10 hover:bg-[#e63946] text-[#e63946] hover:text-white p-3 rounded-full transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg></button>
        </div>
       </div>
      </div><!-- Product Card 4 -->
      <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
       <div class="h-48 bg-gradient-to-br from-[#fff5f5] to-[#ffe3e3] flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[#e63946]/5 group-hover:bg-[#e63946]/10 transition-colors"></div><span class="text-7xl group-hover:scale-110 transition-transform">🥚</span>
       </div>
       <div class="p-6">
        <h3 class="font-display text-xl font-bold text-gray-800 mb-2">Fresh Eggs</h3>
        <p class="text-gray-500 text-sm mb-4">Farm fresh eggs, packed with nutrition</p>
        <div class="flex items-center justify-between"><span class="text-[#e63946] font-bold text-xl">₹7/piece</span> <button class="bg-[#e63946]/10 hover:bg-[#e63946] text-[#e63946] hover:text-white p-3 rounded-full transition-all">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewbox="0 0 24 24">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg></button>
        </div>
       </div>
      </div>
     </div>
    </div>
   </section><!-- Why Choose Us -->
   <section id="about" class="bg-white py-20 px-4">
    <div class="max-w-7xl mx-auto">
     <div class="text-center mb-16"><span class="text-[#e63946] font-semibold text-sm uppercase tracking-wider">Why Choose Us</span>
      <h2 class="font-display text-3xl md:text-5xl text-gray-800 font-bold mt-2">Quality You Can Trust</h2>
     </div>
     <div class="grid md:grid-cols-3 gap-8">
      <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-[#fff5f5] to-white border border-[#e63946]/10 hover:shadow-xl transition-all">
       <div class="w-20 h-20 bg-[#e63946]/10 rounded-2xl flex items-center justify-center mx-auto mb-6"><span class="text-4xl">🏪</span>
       </div>
       <h3 class="font-display text-xl font-bold text-gray-800 mb-3">Farm Fresh Daily</h3>
       <p class="text-gray-600">Sourced directly from our farms every morning. No frozen, no stale - only fresh!</p>
      </div>
      <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-[#fff5f5] to-white border border-[#e63946]/10 hover:shadow-xl transition-all">
       <div class="w-20 h-20 bg-[#e63946]/10 rounded-2xl flex items-center justify-center mx-auto mb-6"><span class="text-4xl">✨</span>
       </div>
       <h3 class="font-display text-xl font-bold text-gray-800 mb-3">100% Halal</h3>
       <p class="text-gray-600">Processed following strict Halal guidelines. Quality and faith combined.</p>
      </div>
      <div class="text-center p-8 rounded-3xl bg-gradient-to-br from-[#fff5f5] to-white border border-[#e63946]/10 hover:shadow-xl transition-all">
       <div class="w-20 h-20 bg-[#e63946]/10 rounded-2xl flex items-center justify-center mx-auto mb-6"><span class="text-4xl">🚚</span>
       </div>
       <h3 class="font-display text-xl font-bold text-gray-800 mb-3">Fast Delivery</h3>
       <p class="text-gray-600">Order now, get it within hours. Fresh chicken at your doorstep!</p>
      </div>
     </div>
    </div>
   </section><!-- Order Section -->
   <section id="order" class="hero-gradient py-20 px-4">
    <div class="max-w-4xl mx-auto">
     <div class="text-center mb-12"><span class="text-[#4ade80] font-semibold text-sm uppercase tracking-wider">Quick Order</span>
      <h2 class="font-display text-3xl md:text-5xl text-white font-bold mt-2">Place Your Order</h2>
      <p class="text-gray-300 mt-4">Fill in your details and we'll contact you to confirm your order.</p>
     </div>
     <form id="order-form" class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 md:p-12 border border-white/10">
      <div class="grid md:grid-cols-2 gap-6 mb-6">
       <div><label class="block text-white font-semibold mb-2">Your Name</label> <input type="text" placeholder="Enter your full name" required class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-[#e63946] transition-colors">
       </div>
       <div><label class="block text-white font-semibold mb-2">Phone Number</label> <input type="tel" placeholder="Your contact number" required class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-[#e63946] transition-colors">
       </div>
      </div>
      <div class="mb-6"><label class="block text-white font-semibold mb-2">Delivery Address</label> <input type="text" placeholder="Enter your complete address" required class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-[#e63946] transition-colors">
      </div>
      <div class="mb-6"><label class="block text-white font-semibold mb-2">Your Order</label> <textarea rows="4" placeholder="e.g., 2kg Whole Chicken, 1kg Boneless, 30 Eggs..." required class="w-full px-5 py-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-400 focus:outline-none focus:border-[#e63946] transition-colors resize-none"></textarea>
      </div><button type="submit" class="w-full bg-[#e63946] hover:bg-[#ff6b6b] text-white py-4 rounded-xl font-bold text-lg transition-all transform hover:scale-[1.02] hover:shadow-lg hover:shadow-[#e63946]/30"> 🛒 Submit Order Request </button>
      <p id="form-message" class="hidden text-center mt-4 text-[#4ade80] font-semibold"></p>
     </form>
    </div>
   </section><!-- Contact Section -->
   <section id="contact" class="bg-[#f8f9fa] py-20 px-4">
    <div class="max-w-7xl mx-auto">
     <div class="grid md:grid-cols-2 gap-12 items-center">
      <div><span class="text-[#e63946] font-semibold text-sm uppercase tracking-wider">Get In Touch</span>
       <h2 class="font-display text-3xl md:text-4xl text-gray-800 font-bold mt-2 mb-6">Contact Us Anytime</h2>
       <p class="text-gray-600 mb-8">Have questions? Need bulk orders? We're here to help! Reach out to us through any of these channels.</p>
       <div class="space-y-6">
        <div class="flex items-center gap-4">
         <div class="w-14 h-14 bg-[#e63946]/10 rounded-2xl flex items-center justify-center flex-shrink-0"><span class="text-2xl">📞</span>
         </div>
         <div>
          <div class="text-gray-500 text-sm">
           Call Us
          </div>
          <div id="contact-phone" class="text-gray-800 font-bold text-lg">
           +91 98765 43210
          </div>
         </div>
        </div>
        <div class="flex items-center gap-4">
         <div class="w-14 h-14 bg-[#e63946]/10 rounded-2xl flex items-center justify-center flex-shrink-0"><span class="text-2xl">📍</span>
         </div>
         <div>
          <div class="text-gray-500 text-sm">
           Visit Us
          </div>
          <div id="contact-address" class="text-gray-800 font-bold text-lg">
           123 Main Market, City Center
          </div>
         </div>
        </div>
        <div class="flex items-center gap-4">
         <div class="w-14 h-14 bg-[#e63946]/10 rounded-2xl flex items-center justify-center flex-shrink-0"><span class="text-2xl">🕐</span>
         </div>
         <div>
          <div class="text-gray-500 text-sm">
           Working Hours
          </div>
          <div class="text-gray-800 font-bold text-lg">
           6:00 AM - 10:00 PM (Daily)
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="bg-gradient-to-br from-[#e63946] to-[#ff6b6b] rounded-3xl p-8 text-white text-center">
       <div class="text-6xl mb-4">
        🐔
       </div>
       <h3 id="footer-shop-name" class="font-display text-2xl font-bold mb-2">Raza Boiler Poultry</h3>
       <p id="footer-tagline" class="opacity-90 mb-6">Fresh Chicken, Happy Families</p>
       <div class="flex justify-center gap-4"><a href="#" class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors" target="_blank" rel="noopener noreferrer"> <span class="text-xl">📱</span> </a> <a href="#" class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors" target="_blank" rel="noopener noreferrer"> <span class="text-xl">💬</span> </a> <a href="#" class="w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center transition-colors" target="_blank" rel="noopener noreferrer"> <span class="text-xl">📸</span> </a>
       </div>
      </div>
     </div>
    </div>
   </section><!-- Footer -->
   <footer class="bg-[#1a1a2e] py-8 px-4">
    <div class="max-w-7xl mx-auto text-center">
     <p class="text-gray-400">© 2024 Raza Boiler Poultry &amp; Chicken Shop. All rights reserved.</p>
     <p class="text-gray-500 text-sm mt-2">Made with ❤️ for fresh chicken lovers</p>
    </div>
   </footer>
  </div>
  <script>
    const defaultConfig = {
      shop_name: "Raza Boiler",
      tagline: "Fresh Chicken, Happy Families",
      hero_title: "Farm Fresh Chicken Delivered to You",
      hero_subtitle: "Premium quality poultry from Raza Boiler. Hygienically processed, delivered fresh to your doorstep within hours.",
      phone_number: "+91 98765 43210",
      address: "123 Main Market, City Center",
      background_color: "#1a1a2e",
      surface_color: "#ffffff",
      text_color: "#1f2937",
      primary_action_color: "#e63946",
      secondary_action_color: "#4ade80"
    };

    let config = { ...defaultConfig };

    async function onConfigChange(cfg) {
      config = { ...defaultConfig, ...cfg };
      
      const customFont = config.font_family || 'DM Sans';
      const baseFontStack = 'DM Sans, sans-serif';
      const displayFontStack = 'Playfair Display, serif';
      
      // Update shop name
      document.getElementById('nav-shop-name').textContent = config.shop_name || defaultConfig.shop_name;
      document.getElementById('footer-shop-name').textContent = config.shop_name + " Poultry" || defaultConfig.shop_name + " Poultry";
      
      // Update tagline
      document.getElementById('footer-tagline').textContent = config.tagline || defaultConfig.tagline;
      
      // Update hero section
      const heroTitle = config.hero_title || defaultConfig.hero_title;
      const titleParts = heroTitle.split(' ');
      const midPoint = Math.ceil(titleParts.length / 2);
      const firstHalf = titleParts.slice(0, midPoint).join(' ');
      const secondHalf = titleParts.slice(midPoint).join(' ');
      document.getElementById('hero-title').innerHTML = `${firstHalf}<br><span class="text-[#e63946]">${secondHalf}</span>`;
      
      document.getElementById('hero-subtitle').textContent = config.hero_subtitle || defaultConfig.hero_subtitle;
      
      // Update contact info
      document.getElementById('contact-phone').textContent = config.phone_number || defaultConfig.phone_number;
      document.getElementById('contact-address').textContent = config.address || defaultConfig.address;
      
      // Apply colors
      document.body.style.setProperty('--primary', config.primary_action_color || defaultConfig.primary_action_color);
      
      // Apply fonts
      document.querySelectorAll('.font-body, p, span, a, button, input, textarea, label').forEach(el => {
        el.style.fontFamily = `${customFont}, ${baseFontStack}`;
      });
      
      document.querySelectorAll('.font-display, h1, h2, h3').forEach(el => {
        el.style.fontFamily = `${customFont}, ${displayFontStack}`;
      });
      
      // Apply font size
      if (config.font_size) {
        const baseSize = config.font_size;
        document.querySelectorAll('p, span, a').forEach(el => {
          if (!el.closest('h1, h2, h3')) {
            el.style.fontSize = `${baseSize}px`;
          }
        });
      }
    }

    function mapToCapabilities(cfg) {
      return {
        recolorables: [
          {
            get: () => cfg.background_color || defaultConfig.background_color,
            set: (value) => { cfg.background_color = value; window.elementSdk.setConfig({ background_color: value }); }
          },
          {
            get: () => cfg.surface_color || defaultConfig.surface_color,
            set: (value) => { cfg.surface_color = value; window.elementSdk.setConfig({ surface_color: value }); }
          },
          {
            get: () => cfg.text_color || defaultConfig.text_color,
            set: (value) => { cfg.text_color = value; window.elementSdk.setConfig({ text_color: value }); }
          },
          {
            get: () => cfg.primary_action_color || defaultConfig.primary_action_color,
            set: (value) => { cfg.primary_action_color = value; window.elementSdk.setConfig({ primary_action_color: value }); }
          },
          {
            get: () => cfg.secondary_action_color || defaultConfig.secondary_action_color,
            set: (value) => { cfg.secondary_action_color = value; window.elementSdk.setConfig({ secondary_action_color: value }); }
          }
        ],
        borderables: [],
        fontEditable: {
          get: () => cfg.font_family || 'DM Sans',
          set: (value) => { cfg.font_family = value; window.elementSdk.setConfig({ font_family: value }); }
        },
        fontSizeable: {
          get: () => cfg.font_size || 16,
          set: (value) => { cfg.font_size = value; window.elementSdk.setConfig({ font_size: value }); }
        }
      };
    }

    function mapToEditPanelValues(cfg) {
      return new Map([
        ["shop_name", cfg.shop_name || defaultConfig.shop_name],
        ["tagline", cfg.tagline || defaultConfig.tagline],
        ["hero_title", cfg.hero_title || defaultConfig.hero_title],
        ["hero_subtitle", cfg.hero_subtitle || defaultConfig.hero_subtitle],
        ["phone_number", cfg.phone_number || defaultConfig.phone_number],
        ["address", cfg.address || defaultConfig.address]
      ]);
    }

    // Initialize SDK
    if (window.elementSdk) {
      window.elementSdk.init({
        defaultConfig,
        onConfigChange,
        mapToCapabilities,
        mapToEditPanelValues
      });
    }

    // Form handling
    document.getElementById('order-form').addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formMessage = document.getElementById('form-message');
      formMessage.textContent = "✅ Thank you! We've received your order request. We'll call you shortly to confirm!";
      formMessage.classList.remove('hidden');
      
      this.reset();
      
      setTimeout(() => {
        formMessage.classList.add('hidden');
      }, 5000);
    });

    // Admin Access Handling
    const ADMIN_CODE = '123456'; // Demo access code
    const adminModal = document.getElementById('admin-modal');
    const adminPanel = document.getElementById('admin-panel');
    const adminAccessBtn = document.getElementById('admin-access-btn');
    const cancelAdminBtn = document.getElementById('cancel-admin-btn');
    const logoutBtn = document.getElementById('logout-btn');
    const adminForm = document.getElementById('admin-form');
    const adminError = document.getElementById('admin-error');
    const adminCodeInput = document.getElementById('admin-code-input');

    // Show admin modal
    adminAccessBtn.addEventListener('click', function() {
      adminModal.classList.remove('hidden');
      adminCodeInput.focus();
      adminError.classList.add('hidden');
      adminForm.reset();
    });

    // Cancel admin access
    cancelAdminBtn.addEventListener('click', function() {
      adminModal.classList.add('hidden');
      adminForm.reset();
      adminError.classList.add('hidden');
    });

    // Admin form submission
    adminForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const enteredCode = adminCodeInput.value.trim();
      
      if (enteredCode === ADMIN_CODE) {
        // Successful access
        adminModal.classList.add('hidden');
        adminPanel.classList.remove('hidden');
        adminForm.reset();
        adminError.classList.add('hidden');
      } else {
        // Show error message
        adminError.textContent = '❌ Invalid access code. Please try again.';
        adminError.classList.remove('hidden');
        adminCodeInput.value = '';
        adminCodeInput.focus();
      }
    });

    // Logout from admin panel
    logoutBtn.addEventListener('click', function() {
      adminPanel.classList.add('hidden');
      adminCodeInput.value = '';
      adminError.classList.add('hidden');
    });

    // Close modal on background click
    adminModal.addEventListener('click', function(e) {
      if (e.target === adminModal) {
        adminModal.classList.add('hidden');
        adminForm.reset();
        adminError.classList.add('hidden');```          
      }
    });
  </script>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9c6fd790426d3e39',t:'MTc2OTkzMjA2MC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>