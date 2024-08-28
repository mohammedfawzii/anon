<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Models\Branch;

class BranchService
{
    public function getAllbranches()
    {
        return Branch::all();
    }

    public function createBranch(array $data)
    {
        $filename = '';
        if (isset($data['img']) && $data['img']->isValid()) {
            $filename = time() . '.' . $data['img']->extension();
            $data['img']->move(public_path('/assets/upload/branch/'), $filename);
            $data['img'] = '/assets/upload/branch/' . $filename;
        }
       $branch= Branch::create($data);
    //    dd($branch);
        return $branch ;
    }

    public function getBranchById($id)
    {
        return Branch::findOrFail($id);
    }

    public function updateBranch(Branch $branch, array $data)
    {
        if (isset($data['img']) && $data['img']->isValid()) {
            $this->deleteImage($branch->img);
            $filename = time() . '.' . $data['img']->extension();
            $data['img']->move(public_path('/assets/upload/branch/'), $filename);
            $data['img'] = '/assets/upload/branch/' . $filename;
        }
        $branch->update($data);

        return $branch;
    }

    public function deleteBranch(Branch $Branch)
    {
        $this->deleteImage($Branch->img);
        return $Branch->delete();
    }

    private function deleteImage($imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }
}
