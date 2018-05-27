<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\User;
use App\Models\Zone;
use App\Models\Bank;
use App\Models\Religion;
use App\Models\Location;
use App\Models\Territory;
use App\Models\Department;
use App\Models\Designation;
use App\Models\LineManager;
use Illuminate\Http\Request;
use App\Models\DefaultModule;
use App\Models\DefaultVehicle;
use App\Models\DefaultLanguage;
use App\Models\MotherOccupation;
use App\Models\FatherOccupation;
use App\Models\DistributionHouse;
use App\Models\IdentificationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;

class UsersController extends Controller
{

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $users = User::with('identificationtype')->paginate(25);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $identificationTypes = IdentificationType::pluck('id','id')->all();
$religions = Religion::pluck('id','id')->all();
$fatherOccupations = FatherOccupation::pluck('id','id')->all();
$motherOccupations = MotherOccupation::pluck('id','id')->all();
$banks = Bank::pluck('id','id')->all();
$defaultModules = DefaultModule::pluck('id','id')->all();
$lineManagers = LineManager::pluck('id','id')->all();
$designations = Designation::pluck('id','id')->all();
$departments = Department::pluck('name','id')->all();
$locations = Location::pluck('id','id')->all();
$defaultVehicles = DefaultVehicle::pluck('id','id')->all();
$defaultLanguages = DefaultLanguage::pluck('id','id')->all();
$territories = Territory::pluck('territory_name','id')->all();
$distributionHouses = DistributionHouse::pluck('market_name','id')->all();
$zones = Zone::pluck('zone_name','id')->all();
$creators = User::pluck('name','id')->all();
$updaters = User::pluck('name','id')->all();
        
        return view('users.create', compact('identificationTypes','religions','fatherOccupations','motherOccupations','banks','defaultModules','lineManagers','designations','departments','locations','defaultVehicles','defaultLanguages','territories','distributionHouses','zones','creators','updaters'));
    }

    /**
     * Store a new user in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            $data['created_by'] = Auth::Id();
            User::create($data);

            return redirect()->route('users.user.index')
                             ->with('success_message', 'User was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::with('identificationtype','religion','fatheroccupation','motheroccupation','bank','defaultmodule','linemanager','designation','department','location','defaultvehicle','defaultlanguage','territory','distributionhouse','zone','creator','updater')->findOrFail($id);

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $identificationTypes = IdentificationType::pluck('id','id')->all();
$religions = Religion::pluck('id','id')->all();
$fatherOccupations = FatherOccupation::pluck('id','id')->all();
$motherOccupations = MotherOccupation::pluck('id','id')->all();
$banks = Bank::pluck('id','id')->all();
$defaultModules = DefaultModule::pluck('id','id')->all();
$lineManagers = LineManager::pluck('id','id')->all();
$designations = Designation::pluck('id','id')->all();
$departments = Department::pluck('name','id')->all();
$locations = Location::pluck('id','id')->all();
$defaultVehicles = DefaultVehicle::pluck('id','id')->all();
$defaultLanguages = DefaultLanguage::pluck('id','id')->all();
$territories = Territory::pluck('territory_name','id')->all();
$distributionHouses = DistributionHouse::pluck('market_name','id')->all();
$zones = Zone::pluck('zone_name','id')->all();
$creators = User::pluck('name','id')->all();
$updaters = User::pluck('name','id')->all();

        return view('users.edit', compact('user','identificationTypes','religions','fatherOccupations','motherOccupations','banks','defaultModules','lineManagers','designations','departments','locations','defaultVehicles','defaultLanguages','territories','distributionHouses','zones','creators','updaters'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            $data['updated_by'] = Auth::Id();
            $user = User::findOrFail($id);
            $user->update($data);

            return redirect()->route('users.user.index')
                             ->with('success_message', 'User was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.user.index')
                             ->with('success_message', 'User was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'name' => 'nullable|string|min:0|max:255',
            'email' => 'required|string|min:1|max:255',
            'password' => 'nullable|string|min:0|max:255',
            'password_key' => 'nullable|string|min:0|max:200',
            'password_expire_days' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'last_name' => 'nullable|string|min:0|max:100',
            'mobile' => 'nullable|string|min:0|max:11',
            'home_telephone' => 'nullable|string|min:0|max:20',
            'username' => 'nullable|string|min:0|max:15',
            'secret_question_1' => 'nullable|string|min:0|max:100',
            'secret_question_2' => 'nullable|string|min:0|max:100',
            'secret_question_ans_1' => 'nullable|string|min:0|max:100',
            'secret_question_ans_2' => 'nullable|string|min:0|max:100',
            'identification_type_id' => 'nullable',
            'identification_number' => 'nullable|numeric|string|min:0|max:30',
            'identification_expire_date' => 'nullable|date_format:j/n/Y',
            'date_of_birth' => 'nullable|date_format:j/n/Y',
            'gender' => 'nullable|string|min:0|max:500',
            'religion_id' => 'nullable',
            'father_name' => 'nullable|string|min:0|max:100',
            'father_occupation_id' => 'nullable',
            'mother_name' => 'nullable|string|min:0|max:100',
            'mother_occupation_id' => 'nullable',
            'bank_account_number' => 'nullable|numeric|string|min:0|max:30',
            'bank_id' => 'nullable',
            'bank_branch' => 'nullable|string|min:0|max:100',
            'last_login_date_time' => 'nullable|date_format:j/n/Y g:i A',
            'default_module_id' => 'nullable',
            'user_image' => 'nullable|numeric|string|min:0|max:100',
            'address' => 'nullable|string|min:0|max:100',
            'is_reliever' => 'nullable|array|string|min:0',
            'reliever_to' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'reliever_start_datetime' => 'nullable|date_format:j/n/Y g:i A',
            'reliever_end_datetime' => 'nullable|date_format:j/n/Y g:i A',
            'line_manager_id' => 'nullable|numeric|min:0|max:4294967295',
            'designation_id' => 'nullable',
            'department_id' => 'nullable',
            'location_id' => 'nullable',
            'default_vehicle_id' => 'nullable',
            'default_url' => 'nullable|string|min:0|max:500',
            'default_language_id' => 'nullable|numeric|min:0|max:4294967295',
            'joining_date' => 'nullable|date_format:j/n/Y',
            'emergency_contact_person_name' => 'nullable|string|min:0|max:100',
            'emergency_contact_relation' => 'nullable|string|min:0|max:30',
            'emergency_contact_number' => 'nullable|numeric|string|min:0|max:20',
            'remember_token' => 'nullable|string|min:0|max:100',
            'territories_id' => 'required',
            'distribution_houses_id' => 'required',
            'rfu1' => 'nullable|string|min:0|max:255',
            'rfu2' => 'nullable|string|min:0|max:255',
            'zones_id' => 'required',
            'created_by' => 'nullable',
            'updated_by' => 'nullable',
            'status' => 'nullable|string|min:0|max:500',
     
        ];
        
        $data = $request->validate($rules);


        return $data;
    }

}
