<!--  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('V_partials/header'); ?>

<body>

    <div class="container-fluid d-flex flex-column">
        <div class="top-0 border-bottom">
            <?php $this->load->view('V_partials/navbar'); ?>
        </div>

        <div class="">
            <?php $this->load->view($content); ?>
        </div>

        <a href="https://wa.me/6287762722287/?text= Hai" class="position-fixed" style="right:0;bottom: 0;z-index: 1;margin:20px;"><i class="fa-brands fa-square-whatsapp " style="color: #17c200;font-size: 100px;"></i>


    </div>

    <div class="footer">
        <?php $this->load->view('V_partials/footer'); ?>
    </div>

    <?php $this->load->view('V_partials/script');
    ?>

    <script>
        const toggleBtn = document.querySelector('.toggle_btn')
        const toggleBtnIcon = document.querySelector('.toggle_btn i')
        const dropDownMenu = document.querySelector('.dropdown_menu')
        const searchForm = document.querySelector('.form-search');
        const searchIcon = document.querySelector('.search-icon');
        const searchIconI = document.querySelector('.search-icon i');

        toggleBtn.onclick = function() {
            dropDownMenu.classList.toggle('open')
            const isOpen = dropDownMenu.classList.contains('open')

            toggleBtnIcon.classList = isOpen ?
                'fa-solid fa-x' :
                'fa-solid fa-bars'
        }

        searchIcon.onclick = function() {
            /**
             * cek apakah class name dari icon i adalah x
             * jika iya maka tutup search form dan ubah icon x menjadi icon search
             */
            if (searchIconI.className == 'fa-solid fa-x') {
                searchForm.style.display = 'none';
                searchIconI.className = 'fa-solid fa-search';

                return;
            }
            /**
             * munculkan search form dan ubah
             * search icon menjadi x
             */
            searchForm.style.display = "flex"
            searchIconI.className = 'fa-solid fa-x';
        }
    </script>
    <!-- scrip review -->

    <!-- endscrip review -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- testimoni -->


</body>


</html>