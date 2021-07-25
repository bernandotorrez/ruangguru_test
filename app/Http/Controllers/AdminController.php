<?php

namespace App\Http\Controllers;

use App\Mail\SendEmailUpdate;
use App\Models\Submissions;
use App\Repositories\Eloquent\SubmissionsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;

class AdminController extends Controller
{

    protected SubmissionsRepository $submissionsRepository;

    public function __construct(SubmissionsRepository $submissionsRepository)
    {
        $this->submissionsRepository = $submissionsRepository;
    }

    public function submissionList()
    {
        return view('pages.admin.submission-list');
    }

    public function dataSubmission()
    {
        $datas = $this->submissionsRepository->view('view_submissions', ['*'], ['is_deleted' => '0']);

        return Datatables::of($datas)
        ->addIndexColumn()
        ->addColumn('action', function($data) {
            return '<label class="new-control new-checkbox checkbox-outline-primary">
            <input type="checkbox" class="new-control-input child-chk checkId"
            onclick="updateCheck(' . $data->id . ')"
            id="' . $data->id . '"
            value="' . $data->id . '">
            <span class="new-control-indicator"></span><span style="visibility:hidden">c</span>
            </label>
            ';
        })
        ->addColumn('isEligible', function($data) {
            return $data->is_eligible == '1' ? 'Eligible' : 'Not Eligible';
        })
        ->addColumn('createdAt', function($data) {
            return date('d M Y', strtotime($data->created_at));
        })
        ->addColumn('statusSubmission', function($data) {
            $checkedCrt = $data->status_submission == 'Crt' ? 'selected' : '';
            $checkedDlv = $data->status_submission == 'Dlv' ? 'selected' : '';
            $checkedRjt = $data->status_submission == 'Rjt' ? 'selected' : '';

            $html = '<select class="form-control" onchange="changeStatusSubmission(this)" data-id="'.$data->id.'" data-user-id="'.$data->user_id.'">';
            $html .= '<option value="Crt" '.$checkedCrt.'>Created</option>';
            $html .= '<option value="Dlv" '.$checkedDlv.'>Delivery</option>';
            $html .= '<option value="Rjt" '.$checkedRjt.'>Rejected</option>';
            $html .= '</select>';

            return $html;
        })
        ->rawColumns(['action', 'statusSubmission'])
        ->make(true);

    }

    public function changeStatusSubmission(Request $request)
    {
        $id = $request->post('id');
        $status = $request->post('status');

        if($status == 'Crt') {
            return response()->json([
                'status' => 'failed',
                'message' => 'Sorry you can\'t select Created Status, please Choose Delivery or Rejected',
                'data' => $id
            ], 200);
        }

        $data = [
            'status_submission' => $status
        ];

        $update = $this->submissionsRepository->update($id, $data);

        if($update) {
            $data = $this->submissionsRepository->getById($id);
            //Mail::to($data->email)->send(new SendEmailUpdate($data));
            Mail::to('bernandotorrez4@gmail.com')->send(new SendEmailUpdate($data));

            return response()->json([
                'status' => 'success',
                'message' => 'Update Status Submission Successfully',
                'data' => $id
            ], 200);
        } else {
            return response()->json([
                'status' => 'fail',
                'message' => 'Update Status Submission Failed',
                'data' => $id
            ], 200);
        }
    }
}
