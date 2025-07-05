@extends('frontends.layouts.master')
@section('content')
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(135deg, #1d3557, #457b9d); color: #fff;">
        <div class="container">
            <a class="navbar-brand text-white fw-bold text-primary" href="#" style="font-size: 1.8rem;">HOME</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#"
                            style="font-size: 1.2rem; margin-right: 15px; transition: color 0.3s;">DOCUMNET</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"
                            style="font-size: 1.2rem; margin-right: 15px; transition: color 0.3s;">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"
                            style="font-size: 1.2rem; transition: color 0.3s;">Contact</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2 shadow-sm" type="search" placeholder="Search" aria-label="Search"
                        style="border-radius: 25px; border: none; padding: 10px 15px;">
                    <button class="btn btn-light fw-bold" type="submit"
                        style="background-color: #32cd32; color: white; border-radius: 25px; padding: 8px 20px; transition: background 0.3s;">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- About Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #1d3557, #457b9d); color: #fff;">
        <div class="container">
            <h2 class="text-center text-uppercase mb-4" style="color: #f8f9fa;">About Document</h2>
            <p class="text-center mb-5" style="color: #d1d1d1;">DocManager is a cutting-edge solution for document
                organization, offering secure storage, fast retrieval, and intuitive management. Built for efficiency, it
                helps businesses of all sizes to stay organized and productive.</p>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="p-4 rounded shadow" style="background-color: #2a2a2a;">
                        <h5 class="mb-3" style="color: #28a745;">🔒 Secure Storage</h5>
                        <p class="mb-0" style="color: #ccc;">Your data is encrypted and safe in our system, ensuring
                            top-notch security.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 rounded shadow" style="background-color: #2a2a2a;">
                        <h5 class="mb-3" style="color: #28a745;">📂 Simplified Management</h5>
                        <p class="mb-0" style="color: #ccc;">Manage all your documents with an intuitive and responsive
                            interface.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 rounded shadow" style="background-color: #2a2a2a;">
                        <h5 class="mb-3" style="color: #28a745;">⚡ Fast Search</h5>
                        <p class="mb-0" style="color: #ccc;">Retrieve documents instantly using robust filters and tag
                            systems.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5" style="background: linear-gradient(135deg, #e3f2fd, #bbdefb);">
        <div class="container">
            <h2 class="text-center mb-4" style="color: #1e88e5; text-transform: uppercase; font-weight: 700;">Our Features
            </h2>
            <p class="text-center mb-5" style="color: #1565c0; font-size: 1.1rem;">Discover the unique features that make
                DocManager your ideal document management solution.</p>
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow text-center h-100"
                        style="background: linear-gradient(135deg, #42a5f5, #64b5f6); color: #ffffff; border-radius: 15px;">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3" style="font-size: 1.5rem; font-weight: bold;">📋 Categorized
                                Documents</h5>
                            <p class="card-text" style="font-size: 1rem;">Effortlessly organize files into custom categories
                                for seamless accessibility.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow text-center h-100"
                        style="background: linear-gradient(135deg, #8e24aa, #ba68c8); color: #ffffff; border-radius: 15px;">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3" style="font-size: 1.5rem; font-weight: bold;">🧑‍💻 User Management
                            </h5>
                            <p class="card-text" style="font-size: 1rem;">Assign roles and control permissions to ensure
                                data security and flexibility.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow text-center h-100"
                        style="background: linear-gradient(135deg, #2e7d32, #66bb6a); color: #ffffff; border-radius: 15px;">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3" style="font-size: 1.5rem; font-weight: bold;">🔍 Advanced Search
                            </h5>
                            <p class="card-text" style="font-size: 1rem;">Search with precision using advanced filters,
                                tags, and dynamic search tools.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="py-5" style="background: linear-gradient(135deg, #007bff, #28a745); color: #fff;">
        <div class="container">
            <h2 class="text-center mb-4 text-uppercase" style="color: #fff;">Contact Us</h2>
            <p class="text-center mb-5" style="color: #d1d1d1;">We’d love to hear from you! Fill out the form below to get
                in touch with us.</p>
            <form class="row g-4 mx-auto" style="max-width: 600px;">
                <div class="col-md-6">
                    <input type="text" class="form-control rounded-pill p-3 shadow-sm" placeholder="Your Name"
                        required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control rounded-pill p-3 shadow-sm" placeholder="Your Email"
                        required>
                </div>
                <div class="col-12">
                    <textarea class="form-control rounded p-3 shadow-sm" rows="5" placeholder="Your Message" required></textarea>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-light rounded-pill px-5 py-2"
                        style="background-color: #ffffff; color: #007bff;">Send Message</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0" style="color: #6c757d;">&copy; 2025 DocManager. All Rights Reserved.</p>
    </footer>
@endsection
