<?php

namespace App\Http\Controllers;

use App\Models\Attendee;
use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
{
	public function workshop(Request $request)
	{
		$attendee_email = Attendee::verify_token($request->token);

		$attendee = Attendee::where('email', $attendee_email)
			->first();

		$attendee->verify_validation();

		$data = [
			'name' => $attendee->name,
			'token' => $request->token,
		];

		view()->share('data', $data);
		$pdf = PDF::loadView('certificates.layout', $data);
		$pdf->setPaper('letter', 'landscape');
		return $pdf->stream();
	}

	public function general(Request $request)
	{
		$attendee_email = Attendee::verify_token($request->token);

		$attendee = Attendee::where('email', $attendee_email)
			->first();
		$attendee->verify_validation();

		$data = [
			'name' => $attendee->name,
			'token' => $request->token,
		];

		view()->share('data', $data);
		$pdf = PDF::loadView('certificates.layout', $data);
		$pdf->setPaper('letter', 'landscape');
		return $pdf->stream();
	}
}
