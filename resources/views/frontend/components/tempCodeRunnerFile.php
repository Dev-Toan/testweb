<?php
<div class="bg" style="width: {{ $item->pro_number ? (($item->pro_number - $item->pro_pay) * 100) / $item->pro_number : 0 }}%"></div>