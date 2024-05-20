@extends('admin.layouts.master')


@section('content')
<div class="wrapper">
        @include('admin.includes.header')
        @include('admin.includes.aside')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Modifier une marque 
                </h1>
            </section>
            <section class="content">
                <div class="row">
                <div class="col-md-12">
                
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Formulaire de modification</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('marques.update', ['marque' => $marque]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <div class="card-body">
                               
                            
                                <div class="form-group">
                                    <label for="nom">Nom de marque</label>
                                    <input type="text" class="form-control" name="nomMarque" value="{{ $marque->nomMarque }}" id="nomMarque" placeholder="Saisir nom de marque">
                                    @error('nomMarque')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                            
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                            <button type="reset" class="btn btn-info">Annuler</button>
                            </div>
                        </form>
                        </div>
                </div>
                  
                </div>
            </section>
        </div>
   


@endsection