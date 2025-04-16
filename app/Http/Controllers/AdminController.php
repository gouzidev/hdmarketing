<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use \App\Models\User;
use App\Http\Middleware\AdminMiddleware;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getUsersPage(Request $req)
    {
        $users = User::paginate(10);
        return view("admin.index",
        ['users' => $users,
        'search' => '']);
    }
    public function getProductsPage(Request $req)
    {
        return view("admin.products");
    }
    public function getDeletedUsersPage(Request $req)
    {
        $users = User::onlyTrashed()->paginate(10);
        return view("admin.deleted-users-page", ['users' => $users]);
    }
    public function destroy(User $user)
    {
        if ($user->is_admin)
        {
            return redirect()->back()
                ->withErrors(['error' => 'لا يمكن حدف حساب مدير'])
                ->withInput();
        }
        $user->delete();
        return back()->with('success', 'تم حذف الحساب بنجاح (يمكن استعادته)');

    }
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        
        return redirect()->route('admin.users.deleted')
               ->with('success', 'تم استعادة الحساب بنجاح');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        
        if ($user->is_admin) {
            return back()->with('error', 'لا يمكن حذف حساب مدير');
        }

        $user->forceDelete();
        return back()->with('success', 'تم الحذف النهائي للحساب');
    }
    public function getEditUserPage(User $user)
    {
        if ($user->is_admin)
        {
            return redirect()->back()
                ->withErrors(['error' => 'لا يمكن تعديل حالة حساب مدير'])
                ->withInput();
        }
        return view("admin.edit-user", ["user" => $user]);
    }
    public function toggleVerification(User $user)
    {
        if ($user->is_admin)
            return redirect()->back()
            ->withErrors(['error' => 'لا يمكن تعديل حالة حساب مدير'])
            ->withInput();
        if (!auth()->user()->is_admin)
        {
            return redirect()->back()
            ->withErrors(['error' => 'غير مصرح بهذا الإجراء'])
            ->withInput();
        }
        $user->update([
            'verified' => !$user->verified,
            'verified_at' => $user->verified ? null : now()
        ]);
        $status = $user->verified ? 'تم توثيق الحساب بنجاح' : 'تم إلغاء توثيق الحساب';
        return back()->with('success', $status);
    }
    public function edit(Request $request, User $user)
    {
        if ($user->is_admin)
            return back()->with('error', 'لا يمكن تعديل حالة حساب مدير');
        $messages = [
            'name.max' => '* يجب ألا يتجاوز اسم المستخدم 255 حرفًا',
            'name.min' => '* يجب أن يحتوي اسم المستخدم على الأقل 3 أحرف',
            'email.email' => '* يجب إدخال بريد إلكتروني صحيح',
            'email.unique' => '* هذا البريد الإلكتروني مستخدم بالفعل',
            'phone.min' => '* يجب أن يتجاوز رقم الهاتف 10 أرقام',
            'phone.max' => '* يجب ألا يتجاوز رقم الهاتف 20 رقماً',
            'city.max' => '* يجب ألا يتجاوز اسم المدينة 255 حرفًا',
            'country.size' => '* يجب اختيار بلد صحيح',
        ];
    
        // Conditional validation rules
        $rules = [
            'name' => 'nullable|string|max:255|min:3',
            'email' => 'nullable|email|max:255|unique:users,email,'.auth()->id(),
            'phone' => 'nullable|string|max:20|min:10',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|size:2',
        ];
        
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        $validatedData = $validator->validated();
    
        if (isset($validatedData['password'])) {
            if (isset($validatedData['confirm']))
            {
                if ($validatedData['password'] == $validatedData['confirm'])
                    $validatedData['password'] = Hash::make($validatedData['password']);
            }
        } else {
            unset($validatedData['password']);
        }
        $user->update($validatedData);
        return back()->with('success', 'تم تحديث البيانات بنجاح');
    }
    public function getSearchedPage(Request $request)
    {
        if (!$request->filled('search'))
        {
            return redirect()->back()
                ->withErrors(['error' => 'يجب إدخال نص للبحث'])
                ->withInput();
        }
        $search = $request->input('search');
        $users = User::where('name', 'like', "%{$search}%")
        ->orWhere('email', 'like', "%{$search}%")->paginate(10);
        return view("admin.index", 
            ['users' => $users],
            ['search' => $search]);
    }
}
