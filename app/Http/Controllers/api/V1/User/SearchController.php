<?php

namespace App\Http\Controllers\API\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\SearchRequest;
use App\Http\Resources\API\V1\Users\SearchResource;
use App\Models\Post;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SearchRequest $request)
    {
        $keyword = $request->search;
        $type = $request->type;

        switch ($type) {
            case 'users':
                $data = User::where('name', 'like', "%$keyword%")
                            ->orWhere('slug', 'like', "%$keyword%");
                break;

            case 'rooms':
                $data = Rooms::where('name', 'like', "%$keyword%")
                            ->orWhere('slug', 'like', "%$keyword%")
                            ->withCount('members');
                break;

            default:
                return $this->sendResponse(200, 'No valid type provided', []);
        }

        $data = $data->paginate(10);


        return $this->sendResponse(200,
        ucfirst($keyword .' at '.$type . ' Search Results') ,
        [
            'count' => $data->count(),
            'data' => SearchResource::collection($data),
            'pagination' => [
                    'total' => $data->total(),
                    'current_page' => $data->currentPage(),
                    'last_page' => $data->lastPage(),
                    'from' => $data->firstItem(),
                    'to' => $data->lastItem(),
                    'first_page_url' => $data->url(1),
                    'last_page_url' => $data->url($data->lastPage()),
                    'next_page_url' => $data->nextPageUrl(),
                    'prev_page_url' => $data->previousPageUrl(),
                ],
            ]
        );
    }

}
