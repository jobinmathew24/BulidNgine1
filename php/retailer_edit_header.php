<div class="navbare">
    <a href="logout.php"  class="loc">Logout</a>
    <a href="#" class="loc">welcome <?php echo($_SESSION['loginid'] )?></a>

    <div class="dropdowne">
        <button class="dropbtn">view a product
        <i class="fa fa-caret-down"></i>
      </button>
      <div class="dropdowne-content">
        <a href="../../onetime/motherboard_one.php"  class="loc">Motherboard</a>
        <a href="../../onetime/cpu_one.php"  class="loc">CPU</a>
        <a href="../../onetime/gpu_one.php"  class="loc">GPU</a>
        <a href="../../onetime/ram_one.php"  class="loc">RAM</a>
        <a href="../../onetime/mem_one.php"  class="loc">Memory</a>
        <a href="../../onetime/mem_m2_one.php"  class="loc">Memory M.2</a>
        <a href="../../onetime/smps_one.php"  class="loc">SMPS</a>
        <a href="../../onetime/cpu_fan_one.php"  class="loc">CPU Fan</a>
        <a href="../../onetime/cabinet_one.php"  class="loc">Cabinet</a>
      </div>
    </div>
    <a href="../../retailer.php"  class="loc">Home</a>
    <form class="" action="" method="post">

      <button type="submit" class="search"><i class="fa fa-search"></i></button>
      <input type="text" name="search_text" placeholder="Search.." value="">
    </form>
    <a href="retailer.php">
    <img src="../../../images/logos/logo_w.png" alt=""></a>
    </div>