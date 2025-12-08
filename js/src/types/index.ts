export * from './dataProvider'


export type TMapData = {
	building: string,
	maps: {
		postId: number,
		top: number,
		left: number,
	}[]
}

export type TListData = {
		postId: number,
		title: string,
		link: string,
		artists: string,
		location: string,
}
