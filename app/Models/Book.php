<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Str;

class Book extends Model
{
    use HasFactory;

        public function author()
    {
        return $this->belongsTo('App\Models\Author', 'author_id', 'id');
    }


    public function store(Request $request)
    {
      
        $fileName = null;
        $fileName = $this->uploadPhoto($request);
       $this->title = $request->book_title;
       $this->isbn = $request->book_isbn;
       $this->pages = $request->book_pages;
       $this->about = $request->book_about;
       $this->author_id = $request->author_id;
       $this->photo = $fileName;
       $this->save();
    }

    public function updateBook(Request $request)
    {
        //if yra foto - istrinam.
        //nepriklausomai nuo to ka katik darem ar nedarem, uploadinam foto
        $this->unlinkPhotos();
       $photoName =  $this->uploadPhoto($request);
       $this->title = $request->book_title;
       $this->isbn = $request->book_isbn;
       $this->pages = $request->book_pages;
       $this->about = $request->book_about;
       $this->author_id = $request->author_id;
       $this->photo = $photoName;
       $this->save();
   }

   public function deleteBook()
   {
       $this->unlinkPhotos();
      $this->delete();
   }

    public function uploadPhoto(Request $request) 
    {
        if ($request->has('photo')) {
            $img = Image::make($request->file('photo'));
            $fileName = Str::random(5).'.jpg';
            $folderBig = public_path('/booksFiles/big');
            $img->resize(1200,null,function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folderBig."/".$fileName,80,'jpg');
    
            $folderSmall = public_path('/booksFiles/small');
            $img->resize(75,null,function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save($folderSmall."/".$fileName,80,'jpg');
            return $fileName;
        }
    }

    public function deletePhoto()
    {
        $this->unlinkPhotos();
        $this->photo = null;
        $this->save();
    }

    public function unlinkPhotos()
    {
        $photoName =  $this->photo;
        if($this->photo !=null){
            // try {
                unlink(public_path('/booksFiles/big/'.$photoName));
            // } catch (\Throwable $th) {
            //     $this->photo = null;
            //     $this->save();
            // }
            // try {
                unlink(public_path('/booksFiles/small/'.$photoName));
            // } catch (\Throwable $th) {
            //     $this->photo = null;
            //     $this->save();
            // }
            }
          
    }

    public function updatePhoto(Request $request)
    {
        $this->deletePhoto();
        $fileName = null;
        $fileName = $this->uploadPhoto($request);
        $this->photo = $fileName;
        $this->save();
    }
    
  
}
