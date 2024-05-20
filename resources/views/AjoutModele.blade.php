@extends('admin.layouts.master')


@section('content')
<div class="wrapper">
        @include('admin.includes.header')
        @include('admin.includes.aside')
        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    Modifier un modèle 
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
                        <form action="{{ route('modeles.update', ['modele' => $modele]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                            <div class="card-body">
                               
                            
                                <div class="form-group">
                                    <label for="nom">Nom de modèle</label>
                                    <input type="text" class="form-control" name="nomModel" value="{{ $modele->nomModel }}" id="nomModel" placeholder="Saisir nom de modèle">
                                    @error('nomModel')
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