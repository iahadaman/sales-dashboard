
<?php 
if(!isset($_SESSION)) 
{ 
  ini_set('session.gc_maxlifetime', 3600);
  session_set_cookie_params(3600);
  session_start(); 
} 
if(!isset($_SESSION["admin_name"])) 
{
  header('location: login.php');
}
require_once '../partials/header.php';?>
    <div class="wrapper">      
       <?php require_once '../partials/sidebar.php';?>
        <!-- Page Content  -->
        <div id="content">
            <?php require_once '../partials/navigation.php';?> 

                <!-- CARD START  -->

            <div id="card">
                <div class="row">  

                <div class="card-box col-md-4 col-sm-6">
                    <div class="card-image card-bg1">
                      <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0)">
                        <path d="M23.9809 17.8113H27.2884C27.9734 17.8113 28.5288 17.2559 28.5288 16.5709C28.5288 15.8859 27.9734 15.3304 27.2884 15.3304H23.9809C23.2959 15.3304 22.7405 15.8859 22.7405 16.5709C22.7405 17.2559 23.2959 17.8113 23.9809 17.8113Z" fill="#454545"/>
                        <path d="M41.7596 20.2921H32.6634V3.34002C32.6634 2.65502 32.1079 2.09961 31.423 2.09961H11.577C10.8921 2.09961 10.3366 2.65502 10.3366 3.34002V20.2921H1.24041C0.555412 20.2921 0 20.8472 0 21.5322V39.7246C0 40.4096 0.555412 40.965 1.24041 40.965H41.7596C42.4446 40.965 43 40.4096 43 39.7246V21.5322C43 20.8472 42.4446 20.2921 41.7596 20.2921ZM29.3558 22.7726H33.4904V28.5612H29.3558V22.7726ZM23.5675 4.58043V10.3688H19.4325V4.58043H23.5675ZM12.8175 4.58043H16.952V11.6092C16.952 12.2942 17.5071 12.8496 18.1925 12.8496H24.8075C25.4929 12.8496 26.048 12.2942 26.048 11.6092V4.58043H30.1825V20.2921H12.8175V4.58043ZM13.2308 22.7726V28.5612H9.09623V22.7726H13.2308ZM2.48082 22.7726H6.61541V29.8017C6.61541 30.4867 7.17082 31.0421 7.85582 31.0421H14.4712C15.1562 31.0421 15.7116 30.4867 15.7116 29.8017V22.7726H20.2596V38.4842H2.48082V22.7726ZM40.5192 38.4842H22.7404V22.7726H26.875V29.8017C26.875 30.4867 27.4304 31.0421 28.1154 31.0421H34.7308C35.4158 31.0421 35.9712 30.4867 35.9712 29.8017V22.7726H40.5192V38.4842Z" fill="#454545"/>
                        <path d="M34.3174 33.5226C33.6321 33.5226 33.077 34.078 33.077 34.763C33.077 35.448 33.6321 36.0034 34.3174 36.0034H37.625C38.31 36.0034 38.8654 35.448 38.8654 34.763C38.8654 34.078 38.31 33.5226 37.625 33.5226H34.3174Z" fill="#454545"/>
                        <path d="M16.9521 33.5226H13.6442C12.9592 33.5226 12.4038 34.078 12.4038 34.763C12.4038 35.448 12.9592 36.0034 13.6442 36.0034H16.9521C17.6371 36.0034 18.1925 35.448 18.1925 34.763C18.1925 34.078 17.6371 33.5226 16.9521 33.5226Z" fill="#454545"/>
                        </g>
                        <defs>
                        <clipPath id="clip0">
                        <rect width="43" height="43" fill="white"/>
                        </clipPath>
                        </defs>
                      </svg>
                    </div>   
                    <div class="card-content my-auto ml-3">
                        <p>Total Projects<br><strong id="totalProjectsNumber"></strong></p>
                    </div> 
                    <div class="card-icon my-auto">  

                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16
                      16">
                         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                      </svg>
                       
                    </div>          
                </div>

                <div class="card-box col-md-4 col-sm-6">   
                    <div class="card-image card-bg2">
                        <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M40.3596 0H2.64033C2.22394 0 1.88599 0.337953 1.88599 0.754348V12.0702C1.88599 12.4865 2.22394 12.8245 2.64033 12.8245H40.3596C40.776 12.8245 41.114 12.4865 41.114 12.0702V0.754348C41.114 0.337953 40.776 0 40.3596 0ZM39.6052 11.3158H3.39468V1.50878H39.6052V11.3158Z" fill="black"/>
<path d="M16.2193 0H2.64033C2.22394 0 1.88599 0.337953 1.88599 0.754348V12.0702C1.88599 12.4865 2.22394 12.8245 2.64033 12.8245H16.2193C16.6357 12.8245 16.9736 12.4865 16.9736 12.0702V0.754348C16.9736 0.337953 16.6357 0 16.2193 0ZM15.4648 11.3158H3.39468V1.50878H15.4648V11.3158Z" fill="black"/>
<path d="M8.45435 8.51926L6.19122 6.25613C5.89702 5.96117 5.41873 5.96117 5.12454 6.25613C4.82958 6.55108 4.82958 7.02786 5.12454 7.32281L7.38766 9.58594C7.5348 9.73308 7.72789 9.80699 7.92105 9.80699C8.11421 9.80699 8.30729 9.73308 8.45443 9.58594C8.74939 9.29099 8.74939 8.81421 8.45435 8.51926Z" fill="black"/>
<path d="M13.7351 3.23867C13.4409 2.94372 12.9626 2.94372 12.6684 3.23867L7.38772 8.51936C7.09277 8.81431 7.09277 9.29109 7.38772 9.58604C7.53486 9.73318 7.72794 9.80709 7.9211 9.80709C8.11427 9.80709 8.30735 9.73318 8.45449 9.58604L13.7352 4.30536C14.03 4.0104 14.03 3.53362 13.7351 3.23867Z" fill="black"/>
<path d="M32.0614 3.77185H19.2369C18.8205 3.77185 18.4825 4.1098 18.4825 4.5262C18.4825 4.94259 18.8205 5.28055 19.2369 5.28055H32.0615C32.4779 5.28055 32.8158 4.94259 32.8158 4.5262C32.8158 4.1098 32.4779 3.77185 32.0614 3.77185Z" fill="black"/>
<path d="M37.3422 3.77185H35.0791C34.6627 3.77185 34.3247 4.1098 34.3247 4.5262C34.3247 4.94259 34.6627 5.28055 35.0791 5.28055H37.3422C37.7586 5.28055 38.0965 4.94259 38.0965 4.5262C38.0965 4.1098 37.7586 3.77185 37.3422 3.77185Z" fill="black"/>
<path d="M37.3421 7.54395H24.5175C24.1011 7.54395 23.7632 7.8819 23.7632 8.29829C23.7632 8.71469 24.1011 9.05264 24.5175 9.05264H37.3421C37.7585 9.05264 38.0965 8.71469 38.0965 8.29829C38.0965 7.8819 37.7585 7.54395 37.3421 7.54395Z" fill="black"/>
<path d="M21.5 7.54395H19.2369C18.8205 7.54395 18.4825 7.8819 18.4825 8.29829C18.4825 8.71469 18.8205 9.05264 19.2369 9.05264H21.5C21.9164 9.05264 22.2544 8.71469 22.2544 8.29829C22.2544 7.8819 21.9164 7.54395 21.5 7.54395Z" fill="black"/>
<path d="M40.3596 15.0876H2.64033C2.22394 15.0876 1.88599 15.4256 1.88599 15.842V27.1578C1.88599 27.5742 2.22394 27.9122 2.64033 27.9122H40.3596C40.776 27.9122 41.114 27.5742 41.114 27.1578V15.8421C41.114 15.4256 40.776 15.0876 40.3596 15.0876ZM39.6052 26.4035H3.39468V16.5964H39.6052V26.4035Z" fill="black"/>
<path d="M16.2193 15.0876H2.64033C2.22394 15.0876 1.88599 15.4256 1.88599 15.842V27.1578C1.88599 27.5742 2.22394 27.9122 2.64033 27.9122H16.2193C16.6357 27.9122 16.9736 27.5742 16.9736 27.1578V15.8421C16.9736 15.4256 16.6357 15.0876 16.2193 15.0876ZM15.4648 26.4035H3.39468V16.5964H15.4648V26.4035Z" fill="black"/>
<path d="M8.45435 23.607L6.19122 21.3439C5.89702 21.0489 5.41873 21.0489 5.12454 21.3439C4.82958 21.6388 4.82958 22.1156 5.12454 22.4106L7.38766 24.6737C7.5348 24.8209 7.72789 24.8948 7.92105 24.8948C8.11421 24.8948 8.30729 24.8209 8.45443 24.6737C8.74939 24.3788 8.74939 23.902 8.45435 23.607Z" fill="black"/>
<path d="M13.7351 18.3263C13.4409 18.0314 12.9626 18.0314 12.6684 18.3263L7.38772 23.607C7.09277 23.902 7.09277 24.3787 7.38772 24.6737C7.53486 24.8208 7.72794 24.8947 7.9211 24.8947C8.11427 24.8947 8.30735 24.8208 8.45449 24.6737L13.7352 19.393C14.03 19.098 14.03 18.6213 13.7351 18.3263Z" fill="black"/>
<path d="M32.0614 18.8596H19.2369C18.8205 18.8596 18.4825 19.1976 18.4825 19.614C18.4825 20.0304 18.8205 20.3683 19.2369 20.3683H32.0615C32.4779 20.3683 32.8158 20.0304 32.8158 19.614C32.8158 19.1976 32.4779 18.8596 32.0614 18.8596Z" fill="black"/>
<path d="M37.3422 18.8596H35.0791C34.6627 18.8596 34.3247 19.1976 34.3247 19.614C34.3247 20.0304 34.6627 20.3683 35.0791 20.3683H37.3422C37.7586 20.3683 38.0965 20.0304 38.0965 19.614C38.0965 19.1976 37.7586 18.8596 37.3422 18.8596Z" fill="black"/>
<path d="M37.3421 22.6316H24.5175C24.1011 22.6316 23.7632 22.9695 23.7632 23.3859C23.7632 23.8023 24.1011 24.1403 24.5175 24.1403H37.3421C37.7585 24.1403 38.0965 23.8023 38.0965 23.3859C38.0965 22.9695 37.7585 22.6316 37.3421 22.6316Z" fill="black"/>
<path d="M21.5 22.6316H19.2369C18.8205 22.6316 18.4825 22.9695 18.4825 23.3859C18.4825 23.8023 18.8205 24.1403 19.2369 24.1403H21.5C21.9164 24.1403 22.2544 23.8023 22.2544 23.3859C22.2544 22.9695 21.9164 22.6316 21.5 22.6316Z" fill="black"/>
<path d="M40.3596 30.1754H2.64033C2.22394 30.1754 1.88599 30.5134 1.88599 30.9298V42.2456C1.88599 42.662 2.22394 42.9999 2.64033 42.9999H40.3596C40.776 42.9999 41.114 42.662 41.114 42.2456V30.9298C41.114 30.5134 40.776 30.1754 40.3596 30.1754ZM39.6052 41.4912H3.39468V31.6842H39.6052V41.4912Z" fill="black"/>
<path d="M16.2193 30.1754H2.64033C2.22394 30.1754 1.88599 30.5134 1.88599 30.9298V42.2456C1.88599 42.662 2.22394 42.9999 2.64033 42.9999H16.2193C16.6357 42.9999 16.9736 42.662 16.9736 42.2456V30.9298C16.9736 30.5134 16.6357 30.1754 16.2193 30.1754ZM15.4648 41.4912H3.39468V31.6842H15.4648V41.4912Z" fill="black"/>
<path d="M8.45435 38.6947L6.19122 36.4315C5.89702 36.1366 5.41873 36.1366 5.12454 36.4315C4.82958 36.7265 4.82958 37.2033 5.12454 37.4982L7.38766 39.7614C7.5348 39.9085 7.72789 39.9824 7.92105 39.9824C8.11421 39.9824 8.30729 39.9085 8.45443 39.7614C8.74939 39.4664 8.74939 38.9896 8.45435 38.6947Z" fill="black"/>
<path d="M13.7351 33.4141C13.4409 33.1191 12.9626 33.1191 12.6684 33.4141L7.38772 38.6948C7.09277 38.9897 7.09277 39.4665 7.38772 39.7615C7.53486 39.9086 7.72794 39.9825 7.9211 39.9825C8.11427 39.9825 8.30735 39.9086 8.45449 39.7615L13.7352 34.4808C14.03 34.1858 14.03 33.709 13.7351 33.4141Z" fill="black"/>
<path d="M32.0614 33.9474H19.2369C18.8205 33.9474 18.4825 34.2853 18.4825 34.7017C18.4825 35.1181 18.8205 35.4561 19.2369 35.4561H32.0615C32.4779 35.4561 32.8158 35.1181 32.8158 34.7017C32.8158 34.2853 32.4779 33.9474 32.0614 33.9474Z" fill="black"/>
<path d="M37.3422 33.9474H35.0791C34.6627 33.9474 34.3247 34.2853 34.3247 34.7017C34.3247 35.1181 34.6627 35.4561 35.0791 35.4561H37.3422C37.7586 35.4561 38.0965 35.1181 38.0965 34.7017C38.0965 34.2853 37.7586 33.9474 37.3422 33.9474Z" fill="black"/>
<path d="M37.3421 37.7192H24.5175C24.1011 37.7192 23.7632 38.0572 23.7632 38.4736C23.7632 38.89 24.1011 39.2279 24.5175 39.2279H37.3421C37.7585 39.2279 38.0965 38.89 38.0965 38.4736C38.0965 38.0572 37.7585 37.7192 37.3421 37.7192Z" fill="black"/>
<path d="M21.5 37.7192H19.2369C18.8205 37.7192 18.4825 38.0572 18.4825 38.4736C18.4825 38.89 18.8205 39.2279 19.2369 39.2279H21.5C21.9164 39.2279 22.2544 38.89 22.2544 38.4736C22.2544 38.0572 21.9164 37.7192 21.5 37.7192Z" fill="black"/>
</svg>

                    </div>   
                    <div class="card-content my-auto ml-3">
                        <p>In Progress Projects<br><strong id="totalProgressProjectsNumber"></strong></p>
                    </div> 
                    <div class="card-icon my-auto">  
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16
                      16">
                         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                      </svg>
                    </div>    
                </div>

                <div class="card-box col-md-4 col-sm-12">   
                    <div class="card-image card-bg3">
                   <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0 13.3829V29.617H43V13.3829H0ZM40.8821 27.4994H2.1176V15.5005H40.8826V27.4994H40.8821ZM9.85337 25.6471H4.20686V17.1771H9.85346V25.6471H9.85337ZM18.3235 25.6471H12.6771V17.1771H18.3235V25.6471ZM27.1464 25.6471H21.4997V17.1771H27.1464V25.6471Z" fill="black"/>
</svg>

                    </div>   
                    <div class="card-content my-auto ml-3">
                        <p>Completed Projects<br><strong id="totalCompletedProjectNumber"></strong></p>
                    </div> 
                    <div class="card-icon my-auto">  
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16
                      16">
                         <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                         <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0
                      0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1
                      0-.708z"/>
                      </svg>
                    </div>    
                </div>   

                <!-- CARD END  -->


                <!-- INPROGRESS CARDS START  -->        

                <div class="col-lg-8 col-md-12 col-sm-12 mt-3">
                    <h5>Recent Projects</h5>
                    <hr>
                    <div class="row">
                        <div class="inprogress-card col-md-6 col-sm-6">

                            <div class="progress-box">
                             <div class="progress-bg2"> </div>
                            </div>

                            <div class="align-self-start progress-report">
                              In Progress
                            </div>

                  
                             <div class="progress-content">
                                    <p>Project Name<br><strong>Webtrixpro</strong></p>
                                    <p>Project Start Date<br><strong>03/02/2021</strong></p>
                                     
                            </div>     

                            <div class="progress-next-content">
                                     <p>Project Platform<br><strong>Web Development</strong></p>            
                                     <p>Client<br><strong><img class="mb-1" style="border-radius:50%;" src="../images/profile.jpg" width="22" height="20"> Ahad Aman</strong></p>
                               <span class="pt-3 pl-2"><a href="#"><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
                                      <a type="button" data-toggle="modal" data-target="#deleteModal" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>    
                                  
                            </div>               
                        </div>

                        <div class="inprogress-card col-md-6 col-sm-6">

                            <div class="progress-box">
                             <div class="progress-bg2"> </div>
                            </div>

                            <div class="align-self-start progress-report">
                              In Progress
                            </div>

                  
                             <div class="progress-content">
                                    <p>Project Name<br><strong>Webtrixpro</strong></p>
                                    <p>Project Start Date<br><strong>03/02/2021</strong></p>                                  
                            </div>     

                            <div class="progress-next-content">
                                    <p>Project Platform<br><strong>Web Development</strong></p>
                                    <p>Client<br><strong> <img style="border-radius:50%;" src="../images/profile.jpg" width="20" height="18"> Ahad Aman</strong></p>
                                    <span class="pt-3 pl-2"><a href="#"><i class="fas fa-edit"></i>&nbsp Edit</a> &nbsp
                                      <a type="button" data-toggle="modal" data-target="#deleteModal" href="#"> <i class="fas fa-trash"></i>&nbspDelete</a> </span>      

                            </div>                                         
                        </div>

                        <div class="col-md-12 col-sm-12 text-right mt-2 pr-4">   
                        <a href="#">View All</a>                         
                        </div> 

                      
                    </div>
                </div>

                <!-- INPROGRESS CARDS END  -->  

                <div class="col-lg-4 col-md-12 col-sm-12 mt-3">   
                    <h5>Quick Access</h5>
                    <hr>
                    <button type="button" data-toggle="modal" data-target="#createProject" class="btn pr-1 btn-big btn-bg btn-lg btn-block">&nbsp &nbsp<i class="fa fa-plus-circle"></i>&nbsp Create Project</button>
                    <button type="button" data-toggle="modal" data-target="#addClient" class="pr-4 btn btn-big btn-bg btn-lg btn-block"><i class="fa fa-plus-circle"></i>&nbsp Add Client</button>                   
                </div>

                <!-- DATA TABLE START  -->  

                <div class="col-md-12 col-sm-12 mt-3">
                     <h5 class="mb-3">Client Information</h5>
                     <div class="table-style px-4 table-responsive">
                     <table class="table table-condensed">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Full Name</th>
                            <th>Company Name</th>
                            <th>Email Address</th>
                            <th>Actions</th>                         
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><img src="../images/profile.jpg"></td>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                            <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                            <td><img src="../images/profile.jpg"></td>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                               <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                          <tr>
                            <td><img src="../images/profile.jpg"></td>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                            <td><img src="../images/profile.jpg"></td>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                              <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                            <td><img src="../images/profile.jpg"></td>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                           <tr>
                            <td><img src="../images/profile.jpg"></td>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                             <td><a href=""><i class="fas fa-edit"></i>&nbsp Edit </a>&nbsp  <a type="button" data-toggle="modal" data-target="#deleteModal" href=""><i class="fas fa-trash"></i>&nbspDelete</a></td>
                          </tr>
                        </tbody>
                      </table>
                      </div>
                </div>

                <div class="col-md-12 col-sm-12 text-right mt-2 pr-4">   
                 <a href="#">View All</a>                         
                </div> 
                     
                <!-- DATA TABLE END  -->  

                </div>
            </div>
                  
        </div>
    </div>
<?php require_once 'modals/delete-modal.php';?>   
<?php require_once 'modals/add-client-modal.php';?>  
<?php require_once 'modals/create-project-modal.php';?>  
<?php require_once '../partials/footer.php';?>   
