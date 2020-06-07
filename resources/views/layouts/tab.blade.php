<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INSTAKASH</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css' ) }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('datatable/font.css' ) }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{asset('datatable/datatable.css')}}" rel="stylesheet">
    <link href="{{asset('datatable/buttons.css')}}" rel="stylesheet">
    <script type="text/javascript" src="{{asset('js/button.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/datatablejQueryMin.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/buttondatatablejQueryMin.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/pdf.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/pdf2.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/html5buttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/print.js')}}"></script>
    <script type="text/javascript" src="{{asset('datatable/dataTable.swf')}}"></script>
    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable( {
                orderCellsTop: true,
                fixedHeader: false,
                "pageLength": 10,
                "order": [[0, "desc"]],
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            } );
        });
    </script>

</head>


<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon rotate-n-15">

            </div>
            <div class="sidebar-brand-text mx-3">INSTAKASH</div>
        </a>

        <hr class="sidebar-divider my-0">

        @php
            $role = '';
            $id = Auth::user()->role_permissions_id;
            $role = \App\Role_User::where('id', $id)->get()->first();
        @endphp

        <li class="nav-item">


            @php

                if(!isset($role->dashboard)|| trim($role->dashboard) == ''){
                     echo '';

                     }else{

                    echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dash" aria-expanded="true" aria-controls="collapseTwo">
                                         <i class="fas fa-fw fa-tachometer-alt"></i>
                                        <span>Dashboard & Reports</span>
                                       </a>';
                    }
            @endphp

            <div id="dash" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Dashboard & Reports</h6>


                    @php
                        if(!isset($role->dashboard)|| trim($role->dashboard) == ''){
                              echo '';

                              }else{


                          echo $display = '<a class="collapse-item" href="/transactions/statistics">Dashboards</a>';

                             }
                    @endphp

                    @php
                        if(!isset($role->reports)|| trim($role->reports) == ''){
                              echo '';

                              }else{


                         // echo $display = '<a class="collapse-item" href="/transactions/display">Card Transactions</a>';

                             }
                    @endphp

                    @php
                        if(!isset($role->reports)|| trim($role->reports) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a  class="collapse-item" href="/transactions/wallet">Wallet Transactions</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->ib_dashboard)|| trim($role->ib_dashboard) == ''){
                              echo '';

                              }else{


                       //   echo $display = '<a class="collapse-item" href="/internet/dashboard">IB Dashboard</a>';

                             }
                    @endphp

                    @php
                        if(!isset($role->ib_transactions)|| trim($role->ib_transactions) == ''){
                              echo '';

                              }else{

                            // echo $display = ' <a  class="collapse-item" href="/internet/transactions">IB Transactions</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->card_production)|| trim($role->card_production) == ''){
                              echo '';

                              }else{

                         //    echo $display = ' <a class="collapse-item" href="/luhn/decommissioned">Suspended Cards</a>';
                             }
                    @endphp

                    @php

                        if(!isset($role->reports)|| trim($role->reports) == ''){
                              echo '';

                              }else{

                           //  echo $display = '<a  class="collapse-item" href="/wallet_configurations/summaries">Wallet E-Value Position</a>';
                             }
                    @endphp

                    @php

                        if(!isset($role->reports)|| trim($role->reports) == ''){
                              echo '';

                              }else{

                          //   echo $display = '<a  class="collapse-item" href="/wallet_configurations/search">Ind. Wallet Transaction</a>';
                             }
                    @endphp

                    @php

                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                              echo '';

                              }else{

                        //     echo $display = '<a  class="collapse-item" href="/eft/status">EFT Switch Status</a>';
                             }
                    @endphp

                    @php

                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                              echo '';

                              }else{

                           //  echo $display = '<a  class="collapse-item" href="/eft/incoming">EFT Messages</a>';
                             }
                    @endphp




                </div>
            </div>


        </li>




        @php

            if(!isset($role->ib_change_status)|| trim($role->ib_change_status) == ''){
                echo '';

                }else{

              // echo $display = ' <hr class="sidebar-divider"><div class="sidebar-heading">Mobile & Internet Banking</div>';
               }
        @endphp

        <li class="nav-item">

            @php
                if(!isset( $role->ib_change_status)|| trim($role->ib_change_status) == ''){
                      echo '';

                      }

                      else{

                   //  echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#internet_" aria-expanded="true" aria-controls="collapseTwo">
                                    //   <i class="fas fa-fw fa-mobile"></i>
                                    //     <span>Internet Banking</span>
                                    //    </a>';
                     }
            @endphp

            <div id="internet_" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Internet Banking</h6>




                    @php
                        if(!isset($role->ib_change_status)|| trim($role->ib_change_status) == ''){
                              echo '';

                              }else{

                            // echo $display = ' <a class="collapse-item" href="/internet/search">Individuals</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->ib_change_status)|| trim($role->ib_change_status) == ''){
                              echo '';

                              }else{

                            // echo $display = ' <a class="collapse-item" href="/multiple/search">Multiple Accounts</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->ib_change_status)|| trim($role->ib_change_status) == ''){
                              echo '';

                              }else{

                            // echo $display = ' <a class="collapse-item" href="/multiple/statement">View Statements</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->corporate)|| trim($role->corporate) == ''){
                              echo '';

                              }else{

                            // echo $display = ' <a  class="collapse-item" href="/corporates/display">Corporates</a>';
                             }
                    @endphp


                    @php
                        if(!isset($role->rtgs)|| trim($role->rtgs) == ''){
                              echo '';

                              }else{

                            // echo $display = ' <a  class="collapse-item" href="/internet/rtgs">RTGS</a>';
                             }
                    @endphp

                </div>
            </div>
        </li>






        <!-- Heading -->
    @php

        if(!isset($role->wallet_services)|| trim($role->wallet_services) == ''){
            echo '';

            }else{

           echo $display = '  <hr class="sidebar-divider"><div class="sidebar-heading">Wallet & Loan Services</div>';
           }
    @endphp





    <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">

            @php
                if(!isset( $role->wallet_services)|| trim($role->wallet_services) == ''){
                      echo '';

                      }

                      else{

                     echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseWallet" aria-expanded="true" aria-controls="collapseTwo">
                                       <i class="fas fa-fw fa-wallet"></i>
                                         <span>Wallets</span>
                                        </a>';
                     }
            @endphp

            <div id="collapseWallet" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Wallet Management</h6>


                    @php
                        if(!isset($role->update_wallet)|| trim($role->update_wallet) == ''){
                              echo '';

                              }else{


                          echo $display = '<a class="collapse-item" href="/wallet/update_view">Manage Wallets</a>';

                             }
                    @endphp

                    @php
                        if(!isset($role->update_wallet)|| trim($role->update_wallet) == ''){
                              echo '';

                              }else{



                       //   echo $display = '<a class="collapse-item" href="/disburse/display">Disbursements</a>';



                             }
                    @endphp

                    @php
                        if(!isset($role->wallet_pin)|| trim($role->wallet_pin) == ''){
                              echo '';

                              }else{

                                /*

                             echo $display = ' <a  class="collapse-item" href="/wallet/reset_view">Wallet PIN Reset</a>';

                                */
                             }
                    @endphp


                    @php
                        if(!isset($role->wallet_configs)|| trim($role->wallet_configs) == ''){
                               echo '';

                               }else{

                              echo $display = ' <a  class="collapse-item" href="/wallet_configurations/display_pending">Deposit</a>';
                              }
                    @endphp

                    @php


                        if(!isset($role->wallet_configs)|| trim($role->wallet_configs) == ''){
                            echo '';

                            }else{

                           echo $display = ' <a class="collapse-item" href="/wallet_configurations/display_pendings">Settlement</a>';
                           }
                    @endphp

                    @php
                        if(!isset($role->update_wallet)|| trim($role->update_wallet) == ''){
                            echo '';

                            }else{


                        //echo //$display = '<a class="collapse-item" href="/wallet_configurations/agent_registration">Register Agent</a>';

                           }
                    @endphp


                    @php
                        if(!isset($role->wallet_configs)|| trim($role->wallet_configs) == ''){
                            echo '';

                            }else{


                        echo $display = '<a class="collapse-item" href="/wallet_configurations/display">Wallet COS</a>';

                           }
                    @endphp
                </div>
            </div>
        </li>

        <li class="nav-item">

            @php
                if(!isset( $role->wallet_services)|| trim($role->loans) == ''){
                      echo '';

                      }

                      else{

                     echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#loans" aria-expanded="true" aria-controls="collapseTwo">
                                       <i class="fas fa-fw fa-dollar-sign"></i>
                                         <span>Loans</span>
                                        </a>';
                     }
            @endphp

            <div id="loans" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Loan Management</h6>


                    @php
                        if(!isset($role->loans)|| trim($role->loans) == ''){
                              echo '';

                              }else{


                          echo $display = '<a class="collapse-item" href="/loans/display">Loan Applications</a>';

                             }
                    @endphp

                    @php
                        if(!isset($role->loans_profile)|| trim($role->loans_profile) == ''){
                              echo '';

                              }else{



                          echo $display = '<a class="collapse-item" href="/loans/profile">Applicant Profile</a>';



                             }
                    @endphp

                    @php
                        if(!isset($role->loan_configurations)|| trim($role->loan_configurations) == ''){
                              echo '';

                              }else{



                           //  echo $display = ' <a  class="collapse-item" href="/loans/cos">Loans COS</a>';


                             }
                    @endphp

                    @php
                        if(!isset($role->loan_configurations)|| trim($role->loan_configurations) == ''){
                              echo '';

                              }else{



                           //  echo $display = ' <a  class="collapse-item" href="/loans/cos">Repayments</a>';


                             }
                    @endphp

                    @php
                        if(!isset($role->loan_configurations)|| trim($role->loan_configurations) == ''){
                              echo '';

                              }else{



                             echo $display = ' <a  class="collapse-item" href="/loans/book">Loan Book</a>';


                             }
                    @endphp


                </div>
            </div>
        </li>







        <!-- Heading -->
    @php
        if(!isset($role->acc)|| trim($role->acc) == ''){
            echo '';

            }else{

           echo $display = '<hr class="sidebar-divider"><div class="sidebar-heading">Card Management</div>';
           }
    @endphp



    <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">

            @php
                if(!isset($role->acc)|| trim($role->acc) == ''){
                      echo '';

                      }else{

                     echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                       <i class="fas fa-fw fa-folder"></i>
                                         <span>Card Management</span>
                                        </a>';
                     }
            @endphp

            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Card Profile Management</h6>


                    @php
                        if(!isset($role->card_initiation)|| trim($role->card_initiation) == ''){
                              echo '';

                              }else{


                          echo $display = '<a class="collapse-item" href="/accountmanagement/link">Link Account</a>';

                             }
                    @endphp

                    @php
                        if(!isset($role->card_auth)|| trim($role->card_auth) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a  class="collapse-item" href="/accountmanagement/display">Card Activation</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->change_status)|| trim($role->change_status) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a  class="collapse-item" href="/accountmanagement/status">Card Status</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->delete_card)|| trim($role->delete_card) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a class="collapse-item" href="/accountmanagement/decommission"> Suspend Card</a>';
                             }
                    @endphp

                </div>
            </div>
        </li>


        <li class="nav-item">
            @php
                if(!isset($role->merchants)|| trim($role->merchants) == ''){
                      echo '';

                      }else{

                     /*echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#merchant_service" aria-expanded="true" aria-controls="collapseTwo">
                                       <i class="fas fa-shopping-cart"></i>
                                         <span>Merchant Services</span>
                                        </a>';
                     */
                     }
            @endphp

            <div id="merchant_service" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Merchant Services</h6>


                    @php
                        if(!isset($role->merchant_profile)|| trim($role->merchant_profile) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a class="collapse-item" href="/merchant/display">Merchant Configurations</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->merchant_acc_management)|| trim($role->merchant_acc_management) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a  class="collapse-item" href="/merchantaccount/display">Merchant Accounts</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->devices)|| trim($role->devices) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a class="collapse-item" href="/devices/display">Device Configurations</a>';
                             }
                    @endphp


                </div>
            </div>
        </li>


        <!-- Divider -->



    @php
        if(!isset($role->card_production)|| trim($role->card_production) == ''){
              echo '';

              }else{

             echo $display = '  <hr class="sidebar-divider"><div class="sidebar-heading">System Configuration</div>';
             }
    @endphp




    <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">

            @php
                if(!isset($role->card_production)|| trim($role->card_production) == ''){
                      echo '';

                      }else{

                     echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                                      <i class="fas fa-fw fa-credit-card"></i>
                                      <span>Card Production</span>
                                     </a>';
                     }
            @endphp

            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    @php
                        if(!isset($role->card_production)|| trim($role->card_production) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a  class="collapse-item" href="/card/display">Configure Card Types</a>';
                             }
                    @endphp

                    @php
                        if(!isset($role->card_production)|| trim($role->card_production) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a class="collapse-item" href="/luhn/display">Generate Cards</a>';
                             }
                    @endphp




                </div>
            </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">

            @php
                if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                      echo '';

                      }else{

                     echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#configs" aria-expanded="true" aria-controls="collapsePages">
                                      <i class="fas fa-fw fa-cogs"></i>
                                      <span>System Configuration</span>
                                     </a>';
                     }
            @endphp

            <div id="configs" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                             echo '';

                             }else{

                             echo $display = ' <a class="collapse-item" href="/product/display">Configure Txn Types</a>';
                            }
                    @endphp

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                             echo '';

                             }else{

                            // echo $display = ' <a class="collapse-item" href="/internet/products/display">Configure IB Products</a>';
                            }
                    @endphp


                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                            echo '';

                            }else{

                          // echo $display = ' <a  class="collapse-item" href="/fee/display">Configure Fees</a>';
                           }
                    @endphp

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                            echo '';

                            }else{

                           echo $display = ' <a  class="collapse-item" href="/internet_fees/display">Configure Wallet Fees</a>';
                           }
                    @endphp

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                             echo '';

                             }else{

                         //   echo $display = ' <a class="collapse-item" href="/bank/display">Configure Bank Profile</a>';
                            }
                    @endphp

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                             echo '';

                             }else{

                           // echo $display = ' <a class="collapse-item" href="/cues/display">Configure Keys</a>';
                            }
                    @endphp


                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                             echo '';

                             }else{

                           // echo $display = ' <a class="collapse-item" href="/cos/display">Configure COS</a>';
                            }
                    @endphp

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                             echo '';

                             }else{

                            //echo $display = ' <a class="collapse-item" href="/eft/restart">Restart EFT Gateway</a>';
                            }
                    @endphp


                </div>
            </div>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">

            @php
                if(!isset($role->users)|| trim($role->users) == ''){
                      echo '';

                      }else{

                     echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users" aria-expanded="true" aria-controls="collapsePages">
                                      <i class="fas fa-fw fa-user"></i>
                                      <span>Users & Access Control</span>
                                     </a>';
                     }
            @endphp

            <div id="users" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    @php
                        if(!isset($role->users)|| trim($role->users) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a class="collapse-item" href="/permissions/display">Configure Permissions</a>';
                             }
                    @endphp


                    @php
                        if(!isset($role->users)|| trim($role->users) == ''){
                             echo '';

                             }else{

                            echo $display = ' <a class="collapse-item" href="/access/roles">Assign Roles</a>';
                            }
                    @endphp


                    @php
                        if(!isset($role->users)|| trim($role->users) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a class="collapse-item" href="/access/state">User State</a>';
                             }
                    @endphp


                    @php
                        if(!isset($role->users)|| trim($role->users) == ''){
                              echo '';

                              }else{

                             echo $display = ' <a class="collapse-item" href="/permissions/users">Users Matrix</a>';
                             }
                    @endphp





                    @php
                        if(!isset($role->users)|| trim($role->users) == ''){
                             echo '';

                             }else{

                            echo $display = ' <a class="collapse-item" href="/logs/display">View User Logs</a>';
                            }
                    @endphp

                </div>
            </div>
        </li>


        <!-- Nav Item - Charts -->
        <li class="nav-item">

            @php
                if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                      echo '';

                      }else{

                     /*echo $display = ' <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#auth" aria-expanded="true" aria-controls="collapsePages">
                                      <i class="fas fa-fw fa-lock"></i>
                                      <span>Authentication Services</span>
                                     </a>';
                     */
                     }
            @endphp

            <div id="auth" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                               echo '';

                               }else{

                               echo $display = ' <a class="collapse-item" href="/authentication/display">Configure Systems</a>';
                              }
                    @endphp


                    @php
                        /*  if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                                 echo '';

                                 }else{

                                 echo $display = ' <a class="collapse-item" href="/roles/display">Configure Roles</a>';
                                }
                            */
                    @endphp

                    @php
                        if(!isset($role->transaction_manager)|| trim($role->transaction_manager) == ''){
                              echo '';

                              }else{

                              echo $display = ' <a class="collapse-item" href="/roles/search">User Management</a>';
                             }
                    @endphp


                </div>
            </div>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>

            @yield('content')

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Insta 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">


                <form class="modal-form" id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button class="btn btn-primary">Logout</button>
                </form>


            </div>
        </div>
    </div>
</div>
</body>
<!--Dropdown Side bar menu-->
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>


</html>






