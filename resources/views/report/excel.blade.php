<table>
  <thead>
      <tr>
          @foreach ($data["main_data"]["HEADER"] as $item)
              <td>{{ $item }}</td>
          @endforeach
      </tr>
  </thead>
  <?php
    unset($data["main_data"]["HEADER"]);
  ?>
  <tbody>
    
        @foreach ($data["main_data"] as $employee_id => $item)
            <tr>
              @foreach ($item as $val)
                <td>{{ $val }}</td>
              @endforeach
            </tr>
        @endforeach
      <tr>
    </tr>
  </tbody>
</table>