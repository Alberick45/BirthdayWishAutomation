<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WishMe</title>
    <link rel="stylesheet" href="plugins/css/styles.css">
    <link href="plugins/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      
    </style>
    <link rel="icon" href="plugins/images/logo1.ico" type="image/png">

    <script>
    window.onload = function() {
        alert("<?php echo $_GET['error']; ?>");
    }
</script>

</head>


<body style=" background-color:#e2e0e0">

  <header class="fixed-top">
    <nav class="navbar navbar-expand-md navbar-dark  bg" id="navbar" style=" position: relative; background-color: blue;">
      <div class="container-fluid">
        <h1 style="width: 80%; color: antiquewhite; font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">WishMe</h1>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signin-modal" style="margin-right: 10px;">Signin</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal" style="margin-right: 10px;">Signup</button>
        </div>
      </div>
    </nav>
  </header>

  <main class="body  px-5 rounded shadow-lg " style="padding-top: 80px; position: relative; ">
    <!-- This is where the main contents are located -->
    <div class="tab-content bg-white" id="nav-tabContent" >
    <div class="nav nav-tabs " id="nav-tab" role="tablist">
      <button class="nav-link btn-primary active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#landingPage" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
      <button class="nav-link btn-primary" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button" role="tab" aria-controls="nav-about" aria-selected="false">About Us</button>
    </div><br>

      <div class="tab-pane fade show  active"  role="tabpanel"  id="landingPage">
          <main class="content ">
            <div class="container-fluid px-3">
              <div id="myCarousel" class="carousel p-2 slide" data-bs-ride="carousel" style="border-top:1px solid ;">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active" data-interval="2000" data-transiton="slide">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                      <img src="plugins/images/img-3.jpg" class="rounded" alt="b">
                    <div class="container">
                      <div class="carousel-caption  text-start">
                        <h1 style=' text-align:center;font-style: oblique; font-family: fantasy; font-size:5vw; color:white;'>Send birthday wishes automatically </h1>
                        <p style="font-family: 'Times New Roman', Times, serif; font-size: 2rem;">Tired of Forgetting the birthdays of your loved ones?<br>Then WisheME is here for you</p>
                        <p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal" style="margin-right: 10px;">Signup Now</button></p>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item"data-interval="2500" data-transiton="zoom">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                      <img src="plugins/images/im2.jpg" alt="">
                    <div class="container">
                      <div class="carousel-caption text-end">
                        <h1 style=' text-align:center;font-style: oblique; font-family: fantasy; font-size:5vw; color:blue;'>Make sure to signup </h1>
                        <p>Skip the explanations and Get It done for you at EASE!!!!!</p>
                        <p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal" style="margin-right: 10px;">Signup Now</button></p>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item"data-interval="2500" data-transiton="zoom">
                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
                      <img src="plugins/images/im4.jpg" alt="">
                    <div class="container">
                      <div class="carousel-caption text-end">
                        <h1>Make sure to signup </h1>
                        <p>Skip the explanations and Get It done for you at EASE!!!!!</p>
                        <p><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signup-modal" style="margin-right: 10px;">Signup Now</button></p>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
            
            <div class="container">
              <div class="row">
                <div class="col-md-6 rounded ">
                  <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"style="border-radius:2rem; ">
                    <div class="col p-4 d-flex flex-column ">
                      <strong class="d-inline-block mb-2 text-primary">FREE</strong>
                      <h2 class="mb-0">'Love'</h2>
                      <div class="mb-1 text-muted">message 1</div>
                      <p class="card-text mb-auto">'.Dear [Name], wishing you a day filled with happiness and a year f.. </p>
                      <a class="stretched-link" data-bs-toggle="modal" data-bs-target="#signup-modal" role="button">Send</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                      <img src='plugins/images/img-1.jpg' width="200" height="250">
                    </div>
                  </div>
                </div>

                <div class="col-md-6 rounded ">
                  <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"style="border-radius:2rem; ">
                    <div class="col p-4 d-flex flex-column ">
                      <strong class="d-inline-block mb-2 text-primary">FREE</strong>
                      <h2 class="mb-0">Special</h2>
                      <div class="mb-1 text-muted">message 2</div>
                      <p class="card-text mb-auto">'On your special day, [Name], as you celebrate turning [Age], I just want to let..</p>
                      <a class="stretched-link" data-bs-toggle="modal" data-bs-target="#signup-modal" role="button">Send</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                      <img src='plugins/images/img-2.jpg' width="200" height="250">
                    </div>
                  </div>
                </div>

                <div class="col-md-6 rounded ">
                  <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"style="border-radius:2rem; ">
                    <div class="col p-4 d-flex flex-column ">
                      <strong class="d-inline-block mb-2 text-primary">FREE</strong>
                      <h2 class="mb-0">Customize</h2>
                      <div class="mb-1 text-muted">message 3</div>
                      <p class="card-text mb-auto">Dear [Name], as you turn [Age], may your birthday be the start of a year filled with good luck, good...</p>
                      <a class="stretched-link" data-bs-toggle="modal" data-bs-target="#signup-modal" role="button">Send</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                      <img src='plugins/images/img-3.jpg' width="200" height="250">
                    </div>
                  </div>
                </div>
                <div class="col-md-6 rounded ">
                  <div class="row g-0 border shadow-lg bg-light overflow-hidden flex-md-row mb-4  h-md-250 position-relative"style="border-radius:2rem; ">
                    <div class="col p-4 d-flex flex-column ">
                      <strong class="d-inline-block mb-2 text-primary">FREE</strong>
                      <h2 class="mb-0">love</h2>
                      <div class="mb-1 text-muted">message 4</div>
                      <p class="card-text mb-auto">It's your [Age]th birthday, [Name]! Time to celebrate, make memories, and have an amazing time....</p>
                      <a class="stretched-link" data-bs-toggle="modal" data-bs-target="#signup-modal" role="button">Send</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                      <img src='plugins/images/img-4.jpg' width="200" height="250">
                    </div>
                  </div>
                </div>
                <hr class="featurette-divider">

              </div>
            </div>
          </main>
      </div>  

      <div class="tab-pane fade" id="about"  role="tabpanel" aria-labelledby="nav-about-tab">
        <section class="aboutUs" id="about" style="background: url(plugins/images/im2.jpg);">
            <main class="container">
                <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
                  <div class="col-md-6 px-0">
                    <h1 class="display-4 fst-italic">About Us</h1>
                    <p class="lead my-3">Welcome to our birthday wishes project! 🎉 We are a passionate team of web programming enthusiasts dedicated to making every birthday special with automated, heartfelt messages. 
                      Our innovative system ensures that no birthday is ever forgotten, delivering personalized wishes straight to your inbox. Join us in celebrating life's milestones with joy and technology!
                    </p>
                  </div>
                </div>
              </main>
        </section>
        <!-- Add more sections as needed -->
         <section class="aboutUs" id="about">
            <main class="container rounded p-4" style="border: 1px solid; height: 30vw;">
                
                <div id="myCarousel-2" class="carousel slide" data-bs-ride="carousel" >
                  <div class="carousel-inner" >
                    <div class="carousel-item active" data-interval="2000">
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Albert.jpg" alt="Albert">
                          <h3>Albert Baiden-Amissah</h3>
                          <p>Supervised and guided the development of backend aspects to achieve project objectives.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Isabel.jpg" alt="Isabel">
                          
                          <h3>Isabel Anane</h3>
                          <p>Contributed to the creation and optimization of user-facing components for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Thomas.jpg" alt="Thomas">
                          
                          <h3>Thomas Twene Appiah</h3>
                          <p>Oversaw the comprehensive development of frontend And Backend components for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                        
                      </div> 
                    </div>
                    <div class="carousel-item"data-interval="3000" >
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Daniel.jpg" alt="Daniel">
                          
                          <h3>Daniel Amemo</h3>
                          <p>Contributed to the creation and optimization of user-facing components for this project</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/serwaah.jpg" alt="serwaah">
                          
                          <h3>Serwaah Acheampong Lydia</h3>
                          <p>Collaborated on the backend development and maintenance of this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Forster.jpg" alt="forster">
                          
                          <h3>Forster Boadu Abboah</h3>
                          <p>Designed and implemented frontend interfaces for this project</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                        
                        
                      </div> 
                    
                    </div>
                    <div class="carousel-item"data-interval="2500" >
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Danny.jpg" alt="Danny">
                          <h3>Daniel Kwabena Onwosi</h3>
                          <p>Helped work on the backend of this project</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Rita.jpg" alt="Rita">
                          
                          <h3>Rita Johnson</h3>
                          <p>Assisted in developing responsive and interactive frontend elements for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/George.jpg" alt="George">
                          <h3>George Kpodo</h3>
                          <p>Focused on backend architecture and coding to enhance the project’s functionality.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                      </div> 
                    </div>
                    <div class="carousel-item" data-interval="2000" >
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Mark.jpg" alt="Mark">
                          
                          <h3>Mark Afedi</h3>
                          <p>Assisted in optimizing and maintaining backend systems for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Erica.jpg" alt="Erica">
                          
                          <h3>Erica</h3>
                          <p>Played a key role in designing and implementing backend solutions for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 shadow-lg rounded">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Saeed.jpg" alt="Saeed">
                          <h3>Saeed Rashid</h3>
                          <p>Assisted in optimizing and maintaining backend systems for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                      </div> 
                    </div>
                    <div class="carousel-item"data-interval="2500" >
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Obed.jpg" alt="Obed">
                          
                          <h3>Frimpong Obed Ebo</h3>
                          <p>Contributed to the creation and optimization of user-facing components for this project</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Kelvin.jpg" alt="Kelvin">
                          
                          <h3>Nana Kofi kelvin</h3>
                          <p>Contributed to the backend development and system integration for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Derrick.jpg" alt="Derrick">
                          
                          <h3>Derick Daffour</h3>
                          <p>Designed and implemented frontend interfaces for this project</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                      </div> 
                    </div>
                    <div class="carousel-item"data-interval="3000" >
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Gilbert.jpg" alt="Gilbert">
                          <h3>Gilbert Adjaho</h3>
                          <p>Focused on backend architecture and coding to enhance the project’s functionality.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/bismark.jpg" alt="bismark">
                          
                          <h3>Bismark Osei tutu berchie</h3>
                          <p>Played a key role in frontend design and development, ensuring a seamless user experience.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/hamza.jpg" alt="hamza">
                          
                          <h3>Hamza Habib</h3>
                          <p>Assisted in optimizing and maintaining backend systems for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                      </div> 
                    </div>
                    <div class="carousel-item " data-interval="2000" >
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Benjamin.jpg" alt="Benjamin">
                          
                          <h3>Benjamin Agyabeng</h3>
                          <p>Participated in the development and refinement of the backend infrastructure for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/aikins.jpg" alt="Aikins">
                          
                          <h3>Nana Aikins</h3>
                          <p>Supported the implementation and optimization of backend systems for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        <div class="col-lg-4 rounded shadow-lg">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Kwame.jpg" alt="nana kwame">
                          <h3>Daneku Domininic Kwame Selasi</h3>
                          <p>Involved in backend programming and system enhancements for this project.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                        
                      </div> 
                    </div>
                    <div class="carousel-item " data-interval="2000" >
                      <div class="row row-md-6  p-1"style=" height: 20vw; ">
                        <div class="col-lg-4 rounded shadow-lg position-relative">
                          <img class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false" src="plugins/images/Molokwu.jpg" alt="Molokwu">
                          <h3>Molokwu Emmanuel</h3>
                          <p>Supervised and guided the development of backend aspects to achieve project objectives.</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" style="margin-right: 10px;">Join Us &raquo;</button>
                        </div>
                      </div>
                    </div>
                    <!-- bring it to the bottom so its only one instead of under each person <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#admin-signup-modal" >Join Us &raquo;</button> -->
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel-2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#myCarousel-2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                  </button>
                  
                </div>
                 
              </main>
        </section>
      </div>

    </div>

    <!-- This is where the hidden signup forms locted -->

  </main>
  
  <div class="modal fade" id="signin-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Signin forms</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="plugins/php/signin.php"  id="signin" method="POST" class="needs-validation" novalidate>
            
            <div class="row g-3">
              <div class="col-12">
                  <div class="input-group has-validation">
                  <span class="input-group-text">@</span>
                  <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
                  <div class="invalid-feedback">
                      Your username is required.
                  </div>
                  </div>
              </div>
              <div class="form-floating">
                  <input type="password" class="form-control" id="password" name="password" required>
                  <label for="password">Password</label>
                  <span class="input-group-text bg-transparent border-0" id="togglePassword">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </span>
                  <div class="invalid-feedback">
                      password is required
                  </div>
              </div>
              <br>
              <button class="w-100 btn btn-primary btn-lg" name="sign_in" >Signin</button>
            </div>    
          </form>
          
          DOn't have an account?<a data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signup-modal" role="button" class="text-primary"> Signup here</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="signup-modal" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Signup forms</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="plugins/php/signup.php" method = 'POST' id="sign_up" class="needs-validation" novalidate>
          <?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		    <?php if(isset($_GET['success'])){ ?>
    		<div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
			</div>
		    <?php } ?>
            <div class="row g-3">
              <div class="col-6">
                <input type="text" class="form-control" placeholder="<?php echo (isset($_GET['fname']))?$_GET['fname']:"first name" ?>" aria-label="First name" name="fname" value="<?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?>">
              </div>
              <div class="col-6">
                <input type="text" class="form-control" placeholder="<?php echo (isset($_GET['lname']))?$_GET['lname']:"last name" ?>" aria-label="Last name" name="lname"value="<?php echo (isset($_GET['lname']))?$_GET['lname']:"" ?>">
              </div>
              <div class="col-12">
                  <div class="input-group has-validation">
                  <span class="input-group-text">@</span>
                  <input type="text" class="form-control" id="username" placeholder="<?php echo (isset($_GET['uname']))?$_GET['uname']:"username" ?>" required name="uname" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
                  <div class="invalid-feedback">
                      Your username is required.
                  </div>
                  </div>
              </div>
              <div class="col-4">
                <select id="country_code"  required class="form-select" name="cntcd">
                  <option selected value="<?php echo (isset($_GET['cntcd']))?$_GET['cntcd']:"country code" ?>"><?php echo (isset($_GET['cntcd']))?$_GET['cntcd']:"country code" ?></option>
                  <option value="+233">Ghana (+233)</option>
                  <option value="93">Afghanistan (+93)</option>
                  <option value="355">Albania (+355)</option>
                  <option value="213">Algeria (+213)</option>
                  <option value="1684">American Samoa (+1684)</option>
                  <option value="376">Andorra (+376)</option>
                  <option value="244">Angola (+244)</option>
                  <option value="1264">Anguilla (+1264)</option>
                  <option value="672">Antarctica (+672)</option>
                  <option value="1268">Antigua and Barbuda (+1268)</option>
                  <option value="54">Argentina (+54)</option>
                  <option value="374">Armenia (+374)</option>
                  <option value="297">Aruba (+297)</option>
                  <option value="61">Australia (+61)</option>
                  <option value="43">Austria (+43)</option>
                  <option value="994">Azerbaijan (+994)</option>
                  <option value="1242">Bahamas (+1242)</option>
                  <option value="973">Bahrain (+973)</option>
                  <option value="880">Bangladesh (+880)</option>
                  <option value="1246">Barbados (+1246)</option>
                  <option value="375">Belarus (+375)</option>
                  <option value="32">Belgium (+32)</option>
                  <option value="501">Belize (+501)</option>
                  <option value="229">Benin (+229)</option>
                  <option value="1441">Bermuda (+1441)</option>
                  <option value="975">Bhutan (+975)</option>
                  <option value="591">Bolivia (+591)</option>
                  <option value="387">Bosnia and Herzegovina (+387)</option>
                  <option value="267">Botswana (+267)</option>
                  <option value="55">Brazil (+55)</option>
                  <option value="246">British Indian Ocean Territory (+246)</option>
                  <option value="1284">British Virgin Islands (+1284)</option>
                  <option value="673">Brunei (+673)</option>
                  <option value="359">Bulgaria (+359)</option>
                  <option value="226">Burkina Faso (+226)</option>
                  <option value="257">Burundi (+257)</option>
                  <option value="855">Cambodia (+855)</option>
                  <option value="237">Cameroon (+237)</option>
                  <option value="1">Canada (+1)</option>
                  <option value="238">Cape Verde (+238)</option>
                  <option value="1345">Cayman Islands (+1345)</option>
                  <option value="236">Central African Republic (+236)</option>
                  <option value="235">Chad (+235)</option>
                  <option value="56">Chile (+56)</option>
                  <option value="86">China (+86)</option>
                  <option value="61">Christmas Island (+61)</option>
                  <option value="61">Cocos Islands (+61)</option>
                  <option value="57">Colombia (+57)</option>
                  <option value="269">Comoros (+269)</option>
                  <option value="682">Cook Islands (+682)</option>
                  <option value="506">Costa Rica (+506)</option>
                  <option value="385">Croatia (+385)</option>
                  <option value="53">Cuba (+53)</option>
                  <option value="599">Curacao (+599)</option>
                  <option value="357">Cyprus (+357)</option>
                  <option value="420">Czech Republic (+420)</option>
                  <option value="45">Denmark (+45)</option>
                  <option value="253">Djibouti (+253)</option>
                  <option value="1767">Dominica (+1767)</option>
                  <option value="1849">Dominican Republic (+1849)</option>
                  <option value="593">Ecuador (+593)</option>
                  <option value="20">Egypt (+20)</option>
                  <option value="503">El Salvador (+503)</option>
                  <option value="240">Equatorial Guinea (+240)</option>
                  <option value="291">Eritrea (+291)</option>
                  <option value="372">Estonia (+372)</option>
                  <option value="251">Ethiopia (+251)</option>
                  <option value="500">Falkland Islands (+500)</option>
                  <option value="298">Faroe Islands (+298)</option>
                  <option value="679">Fiji (+679)</option>
                  <option value="358">Finland (+358)</option>
                  <option value="33">France (+33)</option>
                  <option value="594">French Guiana (+594)</option>
                  <option value="689">French Polynesia (+689)</option>
                  <option value="241">Gabon (+241)</option>
                  <option value="220">Gambia (+220)</option>
                  <option value="995">Georgia (+995)</option>
                  <option value="49">Germany (+49)</option>
                  <option value="350">Gibraltar (+350)</option>
                  <option value="30">Greece (+30)</option>
                  <option value="299">Greenland (+299)</option>
                  <option value="1473">Grenada (+1473)</option>
                  <option value="590">Guadeloupe (+590)</option>
                  <option value="1671">Guam (+1671)</option>
                  <option value="502">Guatemala (+502)</option>
                  <option value="224">Guinea (+224)</option>
                  <option value="245">Guinea-Bissau (+245)</option>
                  <option value="592">Guyana (+592)</option>
                  <option value="509">Haiti (+509)</option>
                  <option value="504">Honduras (+504)</option>
                  <option value="852">Hong Kong (+852)</option>
                  <option value="36">Hungary (+36)</option>
                  <option value="354">Iceland (+354)</option>
                  <option value="91">India (+91)</option>
                  <option value="62">Indonesia (+62)</option>
                  <option value="98">Iran (+98)</option>
                  <option value="964">Iraq (+964)</option>
                  <option value="353">Ireland (+353)</option>
                  <option value="972">Israel (+972)</option>
                  <option value="39">Italy (+39)</option>
                  <option value="225">Ivory Coast (+225)</option>
                  <option value="1876">Jamaica (+1876)</option>
                  <option value="81">Japan (+81)</option>
                  <option value="962">Jordan (+962)</option>
                  <option value="7">Kazakhstan (+7)</option>
                  <option value="254">Kenya (+254)</option>
                  <option value="686">Kiribati (+686)</option>
                  <option value="383">Kosovo (+383)</option>
                  <option value="965">Kuwait (+965)</option>
                  <option value="996">Kyrgyzstan (+996)</option>
                  <option value="856">Laos (+856)</option>
                  <option value="371">Latvia (+371)</option>
                  <option value="961">Lebanon (+961)</option>
                  <option value="266">Lesotho (+266)</option>
                  <option value="231">Liberia (+231)</option>
                  <option value="218">Libya (+218)</option>
                  <option value="423">Liechtenstein (+423)</option>
                  <option value="370">Lithuania (+370)</option>
                  <option value="352">Luxembourg (+352)</option>
                  <option value="853">Macau (+853)</option>
                  <option value="389">Macedonia (+389)</option>
                  <option value="261">Madagascar (+261)</option>
                  <option value="265">Malawi (+265)</option>
                  <option value="60">Malaysia (+60)</option>
                  <option value="960">Maldives (+960)</option>
                  <option value="223">Mali (+223)</option>
                  <option value="356">Malta (+356)</option>
                  <option value="692">Marshall Islands (+692)</option>
                  <option value="596">Martinique (+596)</option>
                  <option value="222">Mauritania (+222)</option>
                  <option value="230">Mauritius (+230)</option>
                  <option value="262">Mayotte (+262)</option>
                  <option value="52">Mexico (+52)</option>
                  <option value="691">Micronesia (+691)</option>
                  <option value="373">Moldova (+373)</option>
                  <option value="377">Monaco (+377)</option>
                  <option value="976">Mongolia (+976)</option>
                  <option value="382">Montenegro (+382)</option>
                  <option value="1664">Montserrat (+1664)</option>
                  <option value="212">Morocco (+212)</option>
                  <option value="258">Mozambique (+258)</option>
                  <option value="95">Myanmar (+95)</option>
                  <option value="264">Namibia (+264)</option>
                  <option value="674">Nauru (+674)</option>
                  <option value="977">Nepal (+977)</option>
                  <option value="31">Netherlands (+31)</option>
                  <option value="687">New Caledonia (+687)</option>
                  <option value="64">New Zealand (+64)</option>
                  <option value="505">Nicaragua (+505)</option>
                  <option value="227">Niger (+227)</option>
                  <option value="234">Nigeria (+234)</option>
                  <option value="683">Niue (+683)</option>
                  <option value="850">North Korea (+850)</option>
                  <option value="1670">Northern Mariana Islands (+1670)</option>
                  <option value="47">Norway (+47)</option>
                  <option value="968">Oman (+968)</option>
                  <option value="92">Pakistan (+92)</option>
                  <option value="680">Palau (+680)</option>
                  <option value="970">Palestine (+970)</option>
                  <option value="507">Panama (+507)</option>
                  <option value="675">Papua New Guinea (+675)</option>
                  <option value="595">Paraguay (+595)</option>
                  <option value="51">Peru (+51)</option>
                  <option value="63">Philippines (+63)</option>
                  <option value="+64">Pitcairn (+64)</option>
                  <option value="+48">Poland (+48)</option>
                  <option value="+351">Portugal (+351)</option>
                  <option value="+1-787">Puerto Rico (+1-787)</option>
                  <option value="+1-939">Puerto Rico (+1-939)</option>
                  <option value="+974">Qatar (+974)</option>
                  <option value="+242">Republic of the Congo (+242)</option>
                  <option value="+40">Romania (+40)</option>
                  <option value="+7">Russia (+7)</option>
                  <option value="+250">Rwanda (+250)</option>
                  <option value="+590">Saint Barthelemy (+590)</option>
                  <option value="+290">Saint Helena (+290)</option>
                  <option value="+1-869">Saint Kitts and Nevis (+1-869)</option>
                  <option value="+1-758">Saint Lucia (+1-758)</option>
                  <option value="+590">Saint Martin (+590)</option>
                  <option value="+508">Saint Pierre and Miquelon (+508)</option>
                  <option value="+1-784">Saint Vincent and the Grenadines (+1-784)</option>
                  <option value="+685">Samoa (+685)</option>
                  <option value="+378">San Marino (+378)</option>
                  <option value="+239">Sao Tome and Principe (+239)</option>
                  <option value="+966">Saudi Arabia (+966)</option>
                  <option value="+221">Senegal (+221)</option>
                  <option value="+381">Serbia (+381)</option>
                  <option value="+248">Seychelles (+248)</option>
                  <option value="+232">Sierra Leone (+232)</option>
                  <option value="+65">Singapore (+65)</option>
                  <option value="+1-721">Sint Maarten (+1-721)</option>
                  <option value="+421">Slovakia (+421)</option>
                  <option value="+386">Slovenia (+386)</option>
                  <option value="+677">Solomon Islands (+677)</option>
                  <option value="+252">Somalia (+252)</option>
                  <option value="+27">South Africa (+27)</option>
                  <option value="+82">South Korea (+82)</option>
                  <option value="+211">South Sudan (+211)</option>
                  <option value="+34">Spain (+34)</option>
                  <option value="+94">Sri Lanka (+94)</option>
                  <option value="+249">Sudan (+249)</option>
                  <option value="+597">Suriname (+597)</option>
                  <option value="+47">Svalbard and Jan Mayen (+47)</option>
                  <option value="+268">Swaziland (+268)</option>
                  <option value="+46">Sweden (+46)</option>
                  <option value="+41">Switzerland (+41)</option>
                  <option value="+963">Syria (+963)</option>
                  <option value="+886">Taiwan (+886)</option>
                  <option value="+992">Tajikistan (+992)</option>
                  <option value="+255">Tanzania (+255)</option>
                  <option value="+66">Thailand (+66)</option>
                  <option value="+228">Togo (+228)</option>
                  <option value="+690">Tokelau (+690)</option>
                  <option value="+676">Tonga (+676)</option>
                  <option value="+1-868">Trinidad and Tobago (+1-868)</option>
                  <option value="+216">Tunisia (+216)</option>
                  <option value="+90">Turkey (+90)</option>
                  <option value="+993">Turkmenistan (+993)</option>
                  <option value="+1-649">Turks and Caicos Islands (+1-649)</option>
                  <option value="+688">Tuvalu (+688)</option>
                  <option value="+1-340">U.S. Virgin Islands (+1-340)</option>
                  <option value="+256">Uganda (+256)</option>
                  <option value="+380">Ukraine (+380)</option>
                  <option value="+971">United Arab Emirates (+971)</option>
                  <option value="+44">United Kingdom (+44)</option>
                  <option value="+1">United States (+1)</option>
                  <option value="+598">Uruguay (+598)</option>
                  <option value="+998">Uzbekistan (+998)</option>
                  <option value="+678">Vanuatu (+678)</option>
                  <option value="+379">Vatican (+379)</option>
                  <option value="+58">Venezuela (+58)</option>
                  <option value="+84">Vietnam (+84)</option>
                  <option value="+681">Wallis and Futuna (+681)</option>
                  <option value="+212">Western Sahara (+212)</option>
                  <option value="+967">Yemen (+967)</option>
                  <option value="+260">Zambia (+260)</option>
                  <option value="+263">Zimbabwe (+263)</option>
                </select>
              </div>
              <div class="col-8">
                  <input type="text" class="form-control"placeholder="<?php echo (isset($_GET['phone']))?$_GET['phone']:"phone" ?>" id="phone" name="phone" required>
                  <div class="invalid-feedback">
                  Please enter your phone number.
                  </div>
              </div>
              <div class="col-12">
                <div class="input-group ">
                <span class="input-group-text">Enter Birthdate</span>
                <input type="date" class="form-control" id="date_of_birth" name="dob" required>
              </div>
                <div class="invalid-feedback">
                input your date of birth.
                </div>
              </div>
              <div class="col-12">
                  <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo (isset($_GET['password']))?$_GET['password']:"Enter a password" ?>" required>
                  <span class="input-group-text bg-transparent border-0" id="togglePassword">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </span>
                  <div class="invalid-feedback">
                      password is required
                  </div>
                  <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                  </div>
              </div>
              <button class="w-100 btn btn-primary btn-lg"  name="sign_up">signup</button>
            </div>    
          </form>
          Already have an account?<a data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#signin-modal" role="button" class="text-primary"> Login here</a>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="admin-signup-modal" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="admin-exampleModalLabel">Admin Signup forms</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="plugins/php/admin_signup.php" method = 'POST' id="sign_up" class="needs-validation" novalidate>
            
          <?php if(isset($_GET['error'])){ ?>
    		<div class="alert alert-danger" role="alert">
			  <?php echo $_GET['error']; ?>
			</div>
		    <?php } ?>

		    <?php if(isset($_GET['success'])){ ?>
    		<div class="alert alert-success" role="alert">
			  <?php echo $_GET['success']; ?>
			</div>
		    <?php } ?>
            <div class="row g-3">
              <div class="col-6">
                <input type="text" class="form-control" placeholder="<?php echo (isset($_GET['fname']))?$_GET['fname']:"first name" ?>" aria-label="First name" name="fname" value="<?php echo (isset($_GET['fname']))?$_GET['fname']:"" ?>">
              </div>
              <div class="col-6">
                <input type="text" class="form-control" placeholder="<?php echo (isset($_GET['lname']))?$_GET['lname']:"last name" ?>" aria-label="Last name" name="lname"value="<?php echo (isset($_GET['lname']))?$_GET['lname']:"" ?>">
              </div>
              <div class="col-12">
                  <div class="input-group has-validation">
                  <span class="input-group-text">@</span>
                  <input type="text" class="form-control" id="username" placeholder="<?php echo (isset($_GET['uname']))?$_GET['uname']:"username" ?>" required name="uname" value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
                  <div class="invalid-feedback">
                      Your username is required.
                  </div>
                  </div>
              </div>
              <div class="col-4">
                <select id="country_code"  required class="form-select" name="cntcd">
                  <option selected value="<?php echo (isset($_GET['cntcd']))?$_GET['cntcd']:"country code" ?>"><?php echo (isset($_GET['cntcd']))?$_GET['cntcd']:"country code" ?></option>
                  <option value="+233">Ghana (+233)</option>
                  <option value="93">Afghanistan (+93)</option>
                  <option value="355">Albania (+355)</option>
                  <option value="213">Algeria (+213)</option>
                  <option value="1684">American Samoa (+1684)</option>
                  <option value="376">Andorra (+376)</option>
                  <option value="244">Angola (+244)</option>
                  <option value="1264">Anguilla (+1264)</option>
                  <option value="672">Antarctica (+672)</option>
                  <option value="1268">Antigua and Barbuda (+1268)</option>
                  <option value="54">Argentina (+54)</option>
                  <option value="374">Armenia (+374)</option>
                  <option value="297">Aruba (+297)</option>
                  <option value="61">Australia (+61)</option>
                  <option value="43">Austria (+43)</option>
                  <option value="994">Azerbaijan (+994)</option>
                  <option value="1242">Bahamas (+1242)</option>
                  <option value="973">Bahrain (+973)</option>
                  <option value="880">Bangladesh (+880)</option>
                  <option value="1246">Barbados (+1246)</option>
                  <option value="375">Belarus (+375)</option>
                  <option value="32">Belgium (+32)</option>
                  <option value="501">Belize (+501)</option>
                  <option value="229">Benin (+229)</option>
                  <option value="1441">Bermuda (+1441)</option>
                  <option value="975">Bhutan (+975)</option>
                  <option value="591">Bolivia (+591)</option>
                  <option value="387">Bosnia and Herzegovina (+387)</option>
                  <option value="267">Botswana (+267)</option>
                  <option value="55">Brazil (+55)</option>
                  <option value="246">British Indian Ocean Territory (+246)</option>
                  <option value="1284">British Virgin Islands (+1284)</option>
                  <option value="673">Brunei (+673)</option>
                  <option value="359">Bulgaria (+359)</option>
                  <option value="226">Burkina Faso (+226)</option>
                  <option value="257">Burundi (+257)</option>
                  <option value="855">Cambodia (+855)</option>
                  <option value="237">Cameroon (+237)</option>
                  <option value="1">Canada (+1)</option>
                  <option value="238">Cape Verde (+238)</option>
                  <option value="1345">Cayman Islands (+1345)</option>
                  <option value="236">Central African Republic (+236)</option>
                  <option value="235">Chad (+235)</option>
                  <option value="56">Chile (+56)</option>
                  <option value="86">China (+86)</option>
                  <option value="61">Christmas Island (+61)</option>
                  <option value="61">Cocos Islands (+61)</option>
                  <option value="57">Colombia (+57)</option>
                  <option value="269">Comoros (+269)</option>
                  <option value="682">Cook Islands (+682)</option>
                  <option value="506">Costa Rica (+506)</option>
                  <option value="385">Croatia (+385)</option>
                  <option value="53">Cuba (+53)</option>
                  <option value="599">Curacao (+599)</option>
                  <option value="357">Cyprus (+357)</option>
                  <option value="420">Czech Republic (+420)</option>
                  <option value="45">Denmark (+45)</option>
                  <option value="253">Djibouti (+253)</option>
                  <option value="1767">Dominica (+1767)</option>
                  <option value="1849">Dominican Republic (+1849)</option>
                  <option value="593">Ecuador (+593)</option>
                  <option value="20">Egypt (+20)</option>
                  <option value="503">El Salvador (+503)</option>
                  <option value="240">Equatorial Guinea (+240)</option>
                  <option value="291">Eritrea (+291)</option>
                  <option value="372">Estonia (+372)</option>
                  <option value="251">Ethiopia (+251)</option>
                  <option value="500">Falkland Islands (+500)</option>
                  <option value="298">Faroe Islands (+298)</option>
                  <option value="679">Fiji (+679)</option>
                  <option value="358">Finland (+358)</option>
                  <option value="33">France (+33)</option>
                  <option value="594">French Guiana (+594)</option>
                  <option value="689">French Polynesia (+689)</option>
                  <option value="241">Gabon (+241)</option>
                  <option value="220">Gambia (+220)</option>
                  <option value="995">Georgia (+995)</option>
                  <option value="49">Germany (+49)</option>
                  <option value="350">Gibraltar (+350)</option>
                  <option value="30">Greece (+30)</option>
                  <option value="299">Greenland (+299)</option>
                  <option value="1473">Grenada (+1473)</option>
                  <option value="590">Guadeloupe (+590)</option>
                  <option value="1671">Guam (+1671)</option>
                  <option value="502">Guatemala (+502)</option>
                  <option value="224">Guinea (+224)</option>
                  <option value="245">Guinea-Bissau (+245)</option>
                  <option value="592">Guyana (+592)</option>
                  <option value="509">Haiti (+509)</option>
                  <option value="504">Honduras (+504)</option>
                  <option value="852">Hong Kong (+852)</option>
                  <option value="36">Hungary (+36)</option>
                  <option value="354">Iceland (+354)</option>
                  <option value="91">India (+91)</option>
                  <option value="62">Indonesia (+62)</option>
                  <option value="98">Iran (+98)</option>
                  <option value="964">Iraq (+964)</option>
                  <option value="353">Ireland (+353)</option>
                  <option value="972">Israel (+972)</option>
                  <option value="39">Italy (+39)</option>
                  <option value="225">Ivory Coast (+225)</option>
                  <option value="1876">Jamaica (+1876)</option>
                  <option value="81">Japan (+81)</option>
                  <option value="962">Jordan (+962)</option>
                  <option value="7">Kazakhstan (+7)</option>
                  <option value="254">Kenya (+254)</option>
                  <option value="686">Kiribati (+686)</option>
                  <option value="383">Kosovo (+383)</option>
                  <option value="965">Kuwait (+965)</option>
                  <option value="996">Kyrgyzstan (+996)</option>
                  <option value="856">Laos (+856)</option>
                  <option value="371">Latvia (+371)</option>
                  <option value="961">Lebanon (+961)</option>
                  <option value="266">Lesotho (+266)</option>
                  <option value="231">Liberia (+231)</option>
                  <option value="218">Libya (+218)</option>
                  <option value="423">Liechtenstein (+423)</option>
                  <option value="370">Lithuania (+370)</option>
                  <option value="352">Luxembourg (+352)</option>
                  <option value="853">Macau (+853)</option>
                  <option value="389">Macedonia (+389)</option>
                  <option value="261">Madagascar (+261)</option>
                  <option value="265">Malawi (+265)</option>
                  <option value="60">Malaysia (+60)</option>
                  <option value="960">Maldives (+960)</option>
                  <option value="223">Mali (+223)</option>
                  <option value="356">Malta (+356)</option>
                  <option value="692">Marshall Islands (+692)</option>
                  <option value="596">Martinique (+596)</option>
                  <option value="222">Mauritania (+222)</option>
                  <option value="230">Mauritius (+230)</option>
                  <option value="262">Mayotte (+262)</option>
                  <option value="52">Mexico (+52)</option>
                  <option value="691">Micronesia (+691)</option>
                  <option value="373">Moldova (+373)</option>
                  <option value="377">Monaco (+377)</option>
                  <option value="976">Mongolia (+976)</option>
                  <option value="382">Montenegro (+382)</option>
                  <option value="1664">Montserrat (+1664)</option>
                  <option value="212">Morocco (+212)</option>
                  <option value="258">Mozambique (+258)</option>
                  <option value="95">Myanmar (+95)</option>
                  <option value="264">Namibia (+264)</option>
                  <option value="674">Nauru (+674)</option>
                  <option value="977">Nepal (+977)</option>
                  <option value="31">Netherlands (+31)</option>
                  <option value="687">New Caledonia (+687)</option>
                  <option value="64">New Zealand (+64)</option>
                  <option value="505">Nicaragua (+505)</option>
                  <option value="227">Niger (+227)</option>
                  <option value="234">Nigeria (+234)</option>
                  <option value="683">Niue (+683)</option>
                  <option value="850">North Korea (+850)</option>
                  <option value="1670">Northern Mariana Islands (+1670)</option>
                  <option value="47">Norway (+47)</option>
                  <option value="968">Oman (+968)</option>
                  <option value="92">Pakistan (+92)</option>
                  <option value="680">Palau (+680)</option>
                  <option value="970">Palestine (+970)</option>
                  <option value="507">Panama (+507)</option>
                  <option value="675">Papua New Guinea (+675)</option>
                  <option value="595">Paraguay (+595)</option>
                  <option value="51">Peru (+51)</option>
                  <option value="63">Philippines (+63)</option>
                  <option value="+64">Pitcairn (+64)</option>
                  <option value="+48">Poland (+48)</option>
                  <option value="+351">Portugal (+351)</option>
                  <option value="+1-787">Puerto Rico (+1-787)</option>
                  <option value="+1-939">Puerto Rico (+1-939)</option>
                  <option value="+974">Qatar (+974)</option>
                  <option value="+242">Republic of the Congo (+242)</option>
                  <option value="+40">Romania (+40)</option>
                  <option value="+7">Russia (+7)</option>
                  <option value="+250">Rwanda (+250)</option>
                  <option value="+590">Saint Barthelemy (+590)</option>
                  <option value="+290">Saint Helena (+290)</option>
                  <option value="+1-869">Saint Kitts and Nevis (+1-869)</option>
                  <option value="+1-758">Saint Lucia (+1-758)</option>
                  <option value="+590">Saint Martin (+590)</option>
                  <option value="+508">Saint Pierre and Miquelon (+508)</option>
                  <option value="+1-784">Saint Vincent and the Grenadines (+1-784)</option>
                  <option value="+685">Samoa (+685)</option>
                  <option value="+378">San Marino (+378)</option>
                  <option value="+239">Sao Tome and Principe (+239)</option>
                  <option value="+966">Saudi Arabia (+966)</option>
                  <option value="+221">Senegal (+221)</option>
                  <option value="+381">Serbia (+381)</option>
                  <option value="+248">Seychelles (+248)</option>
                  <option value="+232">Sierra Leone (+232)</option>
                  <option value="+65">Singapore (+65)</option>
                  <option value="+1-721">Sint Maarten (+1-721)</option>
                  <option value="+421">Slovakia (+421)</option>
                  <option value="+386">Slovenia (+386)</option>
                  <option value="+677">Solomon Islands (+677)</option>
                  <option value="+252">Somalia (+252)</option>
                  <option value="+27">South Africa (+27)</option>
                  <option value="+82">South Korea (+82)</option>
                  <option value="+211">South Sudan (+211)</option>
                  <option value="+34">Spain (+34)</option>
                  <option value="+94">Sri Lanka (+94)</option>
                  <option value="+249">Sudan (+249)</option>
                  <option value="+597">Suriname (+597)</option>
                  <option value="+47">Svalbard and Jan Mayen (+47)</option>
                  <option value="+268">Swaziland (+268)</option>
                  <option value="+46">Sweden (+46)</option>
                  <option value="+41">Switzerland (+41)</option>
                  <option value="+963">Syria (+963)</option>
                  <option value="+886">Taiwan (+886)</option>
                  <option value="+992">Tajikistan (+992)</option>
                  <option value="+255">Tanzania (+255)</option>
                  <option value="+66">Thailand (+66)</option>
                  <option value="+228">Togo (+228)</option>
                  <option value="+690">Tokelau (+690)</option>
                  <option value="+676">Tonga (+676)</option>
                  <option value="+1-868">Trinidad and Tobago (+1-868)</option>
                  <option value="+216">Tunisia (+216)</option>
                  <option value="+90">Turkey (+90)</option>
                  <option value="+993">Turkmenistan (+993)</option>
                  <option value="+1-649">Turks and Caicos Islands (+1-649)</option>
                  <option value="+688">Tuvalu (+688)</option>
                  <option value="+1-340">U.S. Virgin Islands (+1-340)</option>
                  <option value="+256">Uganda (+256)</option>
                  <option value="+380">Ukraine (+380)</option>
                  <option value="+971">United Arab Emirates (+971)</option>
                  <option value="+44">United Kingdom (+44)</option>
                  <option value="+1">United States (+1)</option>
                  <option value="+598">Uruguay (+598)</option>
                  <option value="+998">Uzbekistan (+998)</option>
                  <option value="+678">Vanuatu (+678)</option>
                  <option value="+379">Vatican (+379)</option>
                  <option value="+58">Venezuela (+58)</option>
                  <option value="+84">Vietnam (+84)</option>
                  <option value="+681">Wallis and Futuna (+681)</option>
                  <option value="+212">Western Sahara (+212)</option>
                  <option value="+967">Yemen (+967)</option>
                  <option value="+260">Zambia (+260)</option>
                  <option value="+263">Zimbabwe (+263)</option>
                </select>
              </div>
              <div class="col-8">
                  <input type="text" class="form-control"placeholder="<?php echo (isset($_GET['phone']))?$_GET['phone']:"phone" ?>" id="phone" name="phone" required>
                  <div class="invalid-feedback">
                  Please enter your phone number.
                  </div>
              </div>
              <div class="col-12">
                <div class="input-group ">
                <span class="input-group-text">Enter Birthdate</span>
                <input type="date" class="form-control" id="date_of_birth" name="dob" required>
              </div>
                <div class="invalid-feedback">
                input your date of birth.
                </div>
              </div>
              <div class="col-12">
                  <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo (isset($_GET['password']))?$_GET['password']:"Enter a password" ?>" required>
                  <span class="input-group-text bg-transparent border-0" id="togglePassword">
                    <i class="bi bi-eye-slash" id="toggleIcon"></i>
                </span>
                  <div class="invalid-feedback">
                      password is required
                  </div>
                  <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                  </div>
              </div>
              <button class="w-100 btn btn-primary btn-lg"  name="sign_up">signup</button>
            </div>     
          </form>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const toggleIcon = document.querySelector('#toggleIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the icon
        if (type === 'password') {
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        } else {
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        }
    });
</script>

    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2024 Group 5, Inc. &middot; <a href="Privacy.html">Privacy</a> &middot; <a href="Terms.html">Terms</a></p>
    </footer>

    <script src="plugins/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/js/script.js"></script>
</body>
</html>
