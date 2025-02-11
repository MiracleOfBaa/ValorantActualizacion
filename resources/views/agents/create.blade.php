<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VALORANT</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    />
    <link rel="icon" href="/Fotos/descarga.jpeg" type="image/x-icon" />
  </head>
  <body class="relative font-sans bg-black bg-cover Fotos">
  @include('partials.navbar')
    <div class="container px-4 py-8 mx-auto">
      <h1 class="mb-6 text-3xl text-center text-gray-200">Create Agent</h1>
      <form
        id="createForm"
        action="{{ route('agents.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="max-w-lg mx-auto"
      >
        @csrf <!-- Token CSRF para seguridad -->

        <div class="mb-4">
          <label for="type" class="block mb-1 text-gray-200">Agent Type</label>
          <select
            id="type"
            name="type"
            class="w-full p-2 text-white bg-black border border-white rounded"
          >
            <option value="centinela">Centinela</option>
            <option value="controlador">Controlador</option>
            <option value="duelista">Duelista</option>
            <option value="iniciador">Iniciador</option>
          </select>
        </div>

        <div class="mb-4">
          <label for="name" class="block mb-1 text-gray-200">Agent Name</label>
          <input
            type="text"
            id="name"
            name="name"
            class="w-full p-2 text-white bg-black border border-white rounded"
          />
        </div>

        <div class="mb-4">
          <label for="description" class="block mb-1 text-gray-200">Agent Description</label>
          <textarea
            id="description"
            name="description"
            class="w-full p-2 text-white bg-black border border-white rounded"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="photo" class="block mb-1 text-gray-200">Agent Photo</label>
          <input
            type="file"
            id="photo"
            name="photo"
            accept="image/*"
            class="w-full text-white bg-black"
          />
        </div>

        <div class="mb-4">
          <label for="wallpaper" class="block mb-1 text-gray-200">Agent Wallpaper</label>
          <input
            type="file"
            id="wallpaper"
            name="wallpaper"
            accept="image/*"
            class="w-full text-white bg-black"
          />
        </div>

        <!-- Sección Q -->
        <div class="mb-4">
          <label for="q_header" class="block mb-1 text-gray-200">Q Header</label>
          <input
            type="text"
            id="q_header"
            name="q_header"
            class="w-full p-2 text-white bg-black border border-white rounded"
          />
        </div>

        <div class="mb-4">
          <label for="q_body" class="block mb-1 text-gray-200">Q Body</label>
          <textarea
            id="q_body"
            name="q_body"
            class="w-full p-2 text-white bg-black border border-white rounded"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="q_video" class="block mb-1 text-gray-200">Q Video</label>
          <input
            type="file"
            id="q_video"
            name="q_video"
            accept="video/*"
            class="w-full text-white bg-black"
          />
        </div>

        <!-- Sección E -->
        <div class="mb-4">
          <label for="e_header" class="block mb-1 text-gray-200">E Header</label>
          <input
            type="text"
            id="e_header"
            name="e_header"
            class="w-full p-2 text-white bg-black border border-white rounded"
          />
        </div>

        <div class="mb-4">
          <label for="e_body" class="block mb-1 text-gray-200">E Body</label>
          <textarea
            id="e_body"
            name="e_body"
            class="w-full p-2 text-white bg-black border border-white rounded"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="e_video" class="block mb-1 text-gray-200">E Video</label>
          <input
            type="file"
            id="e_video"
            name="e_video"
            accept="video/*"
            class="w-full text-white bg-black"
          />
        </div>

        <!-- Sección C -->
        <div class="mb-4">
          <label for="c_header" class="block mb-1 text-gray-200">C Header</label>
          <input
            type="text"
            id="c_header"
            name="c_header"
            class="w-full p-2 text-white bg-black border border-white rounded"
          />
        </div>

        <div class="mb-4">
          <label for="c_body" class="block mb-1 text-gray-200">C Body</label>
          <textarea
            id="c_body"
            name="c_body"
            class="w-full p-2 text-white bg-black border border-white rounded"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="c_video" class="block mb-1 text-gray-200">C Video</label>
          <input
            type="file"
            id="c_video"
            name="c_video"
            accept="video/*"
            class="w-full text-white bg-black"
          />
        </div>

        <!-- Sección X -->
        <div class="mb-4">
          <label for="x_header" class="block mb-1 text-gray-200">X Header</label>
          <input
            type="text"
            id="x_header"
            name="x_header"
            class="w-full p-2 text-white bg-black border border-white rounded"
          />
        </div>

        <div class="mb-4">
          <label for="x_body" class="block mb-1 text-gray-200">X Body</label>
          <textarea
            id="x_body"
            name="x_body"
            class="w-full p-2 text-white bg-black border border-white rounded"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="x_video" class="block mb-1 text-gray-200">X Video</label>
          <input
            type="file"
            id="x_video"
            name="x_video"
            accept="video/*"
            class="w-full text-white bg-black"
          />
        </div>

        <!-- Botón para crear el agente -->
        <button
          type="submit"
          class="w-full py-2 text-white bg-blue-500 rounded hover:bg-blue-600"
        >
          <i class="mr-1 fa fa-plus"></i>
          Create Agent
        </button>
      </form>
    </div>
  </body>
</html>
