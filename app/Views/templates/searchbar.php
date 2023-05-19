
<style>
  .hero {
    background-color: #a0a4a5;
    transition: background-color 2s ease-in-out;
  }
  .hero.is-scrolled {
    background-color: transparent;
  }
    .hero .form-control {
        border-radius: 0;
        border: 0;
        border-bottom: 1px solid #fff;
        box-shadow: none;
        font-size: 2rem;
        padding: 0.5rem 0;
        text-align: center;
        transition: all 0.5s ease-in-out;
    }

    .hero .form-control:focus {
        border-color: #fff;
        box-shadow: none;
        outline: none;
    }
    .hero .form-control::-webkit-input-placeholder {
        color: #fff;
        opacity: 1;
    }
    .hero .form-control::-moz-placeholder {
        color: #fff;
        opacity: 1;
    }
    .hero .form-control:-ms-input-placeholder {
        color: #fff;
        opacity: 1;
    }
    .hero .form-control::placeholder {
        color: #fff;
        opacity: 1;
    }
    .hero .btn-primary {
        background-color: #fff;
        border-radius: 0;
        border: 0;
        box-shadow: none;
        color: #000;
        font-size: 1.5rem;
        font-weight: 700;
        padding: 0.5rem 2rem;
        transition: all 0.5s ease-in-out;
    }
    .hero .btn-primary:hover {
        background-color: #000;
        color: #fff;
    }
    .hero .dropdown-menu {
        background-color: #fff;
        border-radius: 0;
        border: 0;
        box-shadow: none;
        color: #000;
        font-size: 1.5rem;
        font-weight: 700;
        padding: 0.5rem 2rem;
        transition: all 0.5s ease-in-out;
    }
    .hero .dropdown-menu:hover {
        background-color: #000;
        color: #fff;
    }
    .hero .dropdown-item {
        background-color: #fff;
        border-radius: 0;
        border: 0;
        box-shadow: none;
        color: #000;
        font-size: 1.5rem;
        font-weight: 700;
        padding: 0.5rem 2rem;
        transition: all 2s ease-in-out;
    }



  #search-results-dropdown {
  position: absolute;
  width: 100%;
  z-index: 1;
  max-height: 200px;
  overflow-y: auto;
}

.dropdown-item {
  white-space: normal !important;
}

#search-results {
    position: absolute;
    width: 100%;
    z-index: 1;
    max-height: none;
    overflow-x: auto;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: none; /* Hide the container initially */
    white-space: nowrap; /* Prevent line breaks */
  }

</style>

<div class="container-fluid hero d-flex justify-content-center align-items-center alignt-items-vertical vh-100 vw-100">
  <div class="col-md-8 text-center">
    <div class="col-md-8 offset-md-2 text-center">
      <h1>Find your perfect teacher</h1>
      <form class="input-group mt-4" method="post" action="/search">
  <?= csrf_field() ?>
  <input type="search" class="form-control" name="search" placeholder="Search Teacher" aria-label="Search" id="search-input" />
  <button class="btn btn-primary" type="submit">
    Search
  </button>
</form>
    </div>
    <div id="search-results" class="container mt-5 mx-2"></div>
  </div>

</div>







<script>
  const hero = document.querySelector('.hero');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 150) {
      hero.classList.add('is-scrolled');
    } else {
      hero.classList.remove('is-scrolled');
    }
  });
  
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            var searchTerm = $(this).val();
            if (searchTerm.length >= 1) {
                // Include CSRF token in the AJAX request
                const csrfName = $('input[name=csrf_test_name]').attr('name');
                const csrfHash = $('input[name=csrf_test_name]').val();
                let postData = {};
                postData[csrfName] = csrfHash;
                postData['search'] = searchTerm;

                $.ajax({
                    url: '/search',
                    method: 'post',
                    data: postData,
                    success: function(data) {
                        $('#search-results').html(data);
                        // Update CSRF token after AJAX request
                        $('input[name=csrf_test_name]').val(data.csrf_test_name);
                        // Show the search results container
                        $('#search-results').show();
                        
                    }
                });
            } else {
                // Hide the search results container when there's no input
                $('#search-results').html('');
                $('#search-results').hide();
            }
        });

        // Hide the search results container when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#search-results, #search-input').length) {
                $('#search-results').hide();
            }
        });
    });
</script>

