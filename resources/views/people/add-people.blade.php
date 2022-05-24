<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Booking Form HTML Template</title>

	<!-- Google font -->
	<link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css" />

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="{{ asset('register/css/bootstrap.min.css')}}" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="{{ asset('register/css/style.css')}}" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="booking-bg">
							<div class="form-header">
								<h2>Make your reservation</h2>
								<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate laboriosam numquam at</p>
							</div>
						</div>
						{!! Form::open(['route' => 'people.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
                            <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">CI</span>
										<input class="form-control" type="text" name="ci" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Nombre</span>
										<input class="form-control" type="text" name="first_name" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Apellido</span>
										<input class="form-control" type="text" name="last_name" required>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Telefono 1</span>
										<input class="form-control" type="text" name="phone1" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Telefono 2</span>
										<input class="form-control" type="text" name="phone2" required>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Fecha  Nacimiento</span>
										<input class="form-control"  name="birth_date" type="date" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Genero</span>
										<select class="form-control" name="sex"required>
                                            <option value="">Seleccione</option>
											<option value="1">Masculino</option>
											<option value="0">Femenino</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<span class="form-label">Direccion</span>
										<textarea class="form-control" name="address" id="" cols="10" rows="10"></textarea>
										<span class="select-arrow"></span>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Usuario</span>
										<input class="form-control" type="email" name="email" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<span class="form-label">Contraseña</span>
										<input class="form-control" type="password" name="password" required>
									</div>
								</div>
							</div>
							<div class="form-btn">
								<button class="submit-btn">Check availability</button>
                                {{-- <button type="submit" class="btn btn-primary btn-sm" title="Registrar..">
                                    Registrar
                                </button> --}}
							</div>
                        {!! Form::close()!!} 
					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>